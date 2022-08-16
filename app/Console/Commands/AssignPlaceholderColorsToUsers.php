<?php

namespace App\Console\Commands;

use App\Actions\GenerateHexColorAction;
use App\Models\User;
use Illuminate\Console\Command;

/**
 * Эта artisan-команда запускается после миграции, чтобы добавить настройку с рандомным цветом аватара для пользователя.
 * Это обеспечивает совместимость логики между старыми и новыми пользователями.
 * После выполнения ВСЕ пользователи будут иметь данную настройку.
 */
class AssignPlaceholderColorsToUsers extends Command
{
    protected $signature = 'user-colors:generate';

    protected $description = 'Assign setting with placeholder color to user not having this setting';

    public function handle()
    {
        User::query()->get()->lazy()->each(function (User $user) {
            if (!$user->hasSetting('placeholder_hex')) {
                $user->setSettingByKey('placeholder_hex', (new GenerateHexColorAction())());
                $user->save();
                $this->info("For user {$user->id} color setting was added");
            }
        });
    }
}
