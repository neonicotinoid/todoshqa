<?php

namespace Tests\Feature;

use App\Http\Livewire\ProfilePage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class ProfilePageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
    }

    public function test_route_not_available_for_guests()
    {
        $this->get(route('profile'))
            ->assertRedirect();
    }

    public function test_it_renders()
    {
        $this->actingAs(User::factory()->create());
        $this->get(route('profile'))
            ->assertSeeLivewire(ProfilePage::class);
    }

    public function test_it_uploads_avatar_for_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $uploadedAvatar = UploadedFile::fake()->image('avatar.png');

        Livewire::test(ProfilePage::class, ['user' => $user])
            ->set('preloadedAvatar', $uploadedAvatar)
            ->call('approvePreloadedAvatar');
        $user->refresh();

        $this->assertFileExists($user->getFirstMedia('avatar')->getPath());
        $this->assertDatabaseHas('media', ['file_name' => 'avatar.png']);
        $this->assertTrue($user->hasMedia('avatar'));
    }

    public function test_it_removes_current_avatar()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $user->addMedia(\Illuminate\Http\Testing\File::fake()->image('avatar.png'))
            ->toMediaCollection('avatar');

        Livewire::test(ProfilePage::class, ['user' => $user])
            ->call('removeAvatar');
        $user->refresh();

        $this->assertDatabaseMissing('media', ['file_name' => 'avatar.png']);
        $this->assertFalse($user->hasMedia('avatar'));


    }

    public function test_user_cant_be_edited_by_another_user()
    {
        [$owner, $random_user] = User::factory(2)->create();
        $this->actingAs($random_user);

        Livewire::test(ProfilePage::class, ['user' => $owner])
            ->assertSet('user.name', $owner->name)
            ->call('saveUser')
            ->assertForbidden()
            ->call('approvePreloadedAvatar')
            ->assertForbidden();
    }
}
