<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia as Assert;
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

    public function test_it_renders_for_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('profile'))
            ->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Auth/Profile')
                ->has('profile')->whereAll([
                    'profile.id' => $user->id,
                    'profile.name' => $user->name,
                ]));
    }

    public function test_it_uploads_avatar_for_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $uploadedAvatar = UploadedFile::fake()->image('avatar.png');

        $this->postJson(route('user.uploadAvatar', ['user' => $user->id]), [
            'avatar' => $uploadedAvatar,
        ]);

        $this->assertFileExists($user->getFirstMedia('avatar')->getPath());
        $this->assertDatabaseHas('media', ['file_name' => 'avatar.png']);
        $this->assertTrue($user->hasMedia('avatar'));
    }

    public function test_it_can_remove_current_avatar()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $user->addMedia(File::fake()->image('avatar.png'))
            ->toMediaCollection('avatar');

        $this->deleteJson(route('user.removeAvatar', ['user' => $user->id]));

        $this->assertDatabaseMissing('media', ['file_name' => 'avatar.png']);
        $this->assertFalse($user->hasMedia('avatar'));
    }

    public function test_user_cant_be_edited_by_another_user()
    {
        [$owner, $random_user] = User::factory(2)->create();
        $this->actingAs($random_user);

        $this->postJson(route('user.update', ['user' => $owner->id]), [
            'name' => 'new username',
            'email' => 'newemail@example.com',
        ])->assertForbidden();

        $this->assertDatabaseMissing('users', [
            'name' => 'new username',
            'email' => 'newemail@example.com',
        ]);
    }
}
