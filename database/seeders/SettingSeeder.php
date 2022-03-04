<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'Цена первого сеанса',
            'key' => 'first_price',
            'value' => '1420',
        ]);

        Setting::create([
            'name' => 'Цена второго сеанса',
            'key' => 'second_price',
            'value' => '1450',
        ]);

        Setting::create([
            'name' => 'Цена сеанса',
            'key' => 'price',
            'value' => '2850',
        ]);

        Setting::create([
            'name' => 'E-mail в подвале',
            'key' => 'email',
            'value' => 'help@insight.bg',
        ]);

        Setting::create([
            'name' => 'Ссылка ВКонтакте',
            'key' => 'vk_link',
            'value' => 'https://vk.com',
        ]);

        Setting::create([
            'name' => 'Логин телеграм (!!не номер телефона!!)',
            'key' => 'telegram',
            'value' => '@nickname',
        ]);

        Setting::create([
            'name' => 'Номер whatsapp',
            'key' => 'whatsapp',
            'value' => '79995555555',
        ]);

        Setting::create([
            'name' => 'Текст внизу страницы',
            'key' => 'powered',
            'value' => 'Важный момент. "Инсайт" — это не скорая психологическая помощь. Если у вас серьезные, угрожающие вашей жизни проблемы, которые требуют немедленного решения, вам лучше обратиться в какую-либо из этих организаций.<br> Регистрация на сайте означает согласие с пользовательским соглашением.',
        ]);

        Setting::create([
            'name' => 'Политика обработки персональных данных',
            'key' => 'policy',
            'value' => ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae esse recusandae rem temporibus vitae. Accusantium autem consequatur dolorem, ea eius facilis incidunt maiores, necessitatibus nesciunt nobis odio, officia veniam. Est.
 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae esse recusandae rem temporibus vitae. Accusantium autem consequatur dolorem, ea eius facilis incidunt maiores, necessitatibus nesciunt nobis odio, officia veniam. Est.
 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae esse recusandae rem temporibus vitae. Accusantium autem consequatur dolorem, ea eius facilis incidunt maiores, necessitatibus nesciunt nobis odio, officia veniam. Est.
 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae esse recusandae rem temporibus vitae. Accusantium autem consequatur dolorem, ea eius facilis incidunt maiores, necessitatibus nesciunt nobis odio, officia veniam. Est.',
        ]);

    }
}
