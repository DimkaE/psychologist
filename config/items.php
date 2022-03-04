<?php

return [
    'payment_fields' => [
        [
            'name' => 'Сумма',
            'key' => 'sum',
            'filter' => 'from_to',
            'field' => 'input',
            'field_type' => 'number',
            'attributes' => 'disabled',
        ], [
            'name' => 'Сумма со скидкой',
            'key' => 'final_sum',
            'filter' => 'from_to',
            'field' => 'input',
            'field_type' => 'number',
            'attributes' => 'disabled',
        ], [
            'name' => 'Статус',
            'key' => 'status',
            'filter' => 'select',
            'field' => 'select',
            'attributes' => 'disabled',
            'values' => config('app.payment_statuses'),
        ], [
            'name' => 'Платежная система',
            'key' => 'system',
            'filter' => 'select',
            'field' => 'select',
            'attributes' => 'disabled',
            'values' => config('app.payment_systems'),
        ], [
            'name' => 'ID платежки',
            'key' => 'ext_id',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => 'disabled',
        ], [
            'name' => 'Дата платежа',
            'key' => 'pay_date',
            'filter' => 'from_to',
            'field' => 'input',
            'field_type' => 'date',
            'attributes' => 'disabled',
        ], [
            'name' => 'Статус выплаты психологу',
            'key' => 'pay_status',
            'filter' => 'select',
            'field' => 'select',
            'attributes' => '',
            'values' => config('app.payment_pay_statuses'),
        ], [
            'name' => 'Сумма выплаты',
            'key' => 'pay_out_sum',
            'filter' => 'from_to',
            'field' => 'input',
            'field_type' => 'number',
            'attributes' => '',
        ],
    ],
    'consultation_fields' => [
        [
            'name' => 'Статус',
            'key' => 'status',
            'filter' => 'select',
            'field' => 'select',
            'attributes' => 'disabled',
            'values' => config('app.consultation_statuses'),
        ]
    ],
    'article_fields' => [
        [
            'name' => 'Дата',
            'key' => 'date',
            'filter' => 'from_to',
            'field' => 'input',
            'field_type' => 'date',
            'attributes' => 'required',
        ], [
            'name' => 'url',
            'key' => 'url',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'Название',
            'key' => 'name',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'Вводный текст',
            'key' => 'intro',
            'filter' => 'like',
            'field' => 'textarea',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'Meta title',
            'key' => 'meta_title',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'Meta description',
            'key' => 'meta_description',
            'filter' => 'like',
            'field' => 'textarea',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'Содержимое',
            'key' => 'text',
            'filter' => 'like',
            'field' => 'textarea',
            'field_type' => 'ckeditor',
            'attributes' => 'required',
        ],
    ],
    'review_fields' => [
        [
            'name' => 'Имя',
            'key' => 'name',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'Описание',
            'key' => 'description',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'Отзыв',
            'key' => 'text',
            'filter' => 'like',
            'field' => 'textarea',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'Порядок сортировки',
            'key' => 'sort_order',
            'filter' => 'from_to',
            'field' => 'input',
            'field_type' => 'number',
            'attributes' => '',
        ], [
            'name' => 'Вопрос для',
            'key' => 'type',
            'filter' => 'select',
            'field' => 'select',
            'attributes' => 'required',
            'values' => config('app.review_types'),
        ]
    ],
    'question_fields' => [
        [
            'name' => 'Вопрос',
            'key' => 'question',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'Ответ',
            'key' => 'answer',
            'filter' => 'like',
            'field' => 'textarea',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'Вопрос для',
            'key' => 'type',
            'filter' => 'select',
            'field' => 'select',
            'attributes' => 'required',
            'values' => config('app.review_types'),
        ]
    ],
    'page_fields' => [
        [
            'name' => 'Заголовок',
            'key' => 'meta_title',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'Описание',
            'key' => 'meta_description',
            'filter' => 'like',
            'field' => 'textarea',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'url',
            'key' => 'url',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ]
    ],
    'user_fields' => [
        [
            'name' => 'Имя',
            'key' => 'name',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'E-mail',
            'key' => 'email',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'email',
            'attributes' => 'required',
        ], [
            'name' => 'Телефон',
            'key' => 'phone',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'phone',
            'attributes' => '',
        ], [
            'name' => 'Роль',
            'key' => 'role',
            'filter' => 'select',
            'field' => 'select',
            'attributes' => 'required',
            'values' => config('app.user_roles'),
        ]
    ],
    'psychologist_fields' => [
        [
            'name' => 'Отчество',
            'key' => 'second_name',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'Фамилия',
            'key' => 'last_name',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'Дата рождения',
            'key' => 'birthdate',
            'filter' => 'from_to',
            'field' => 'input',
            'field_type' => 'date',
            'attributes' => '',
        ], [
            'name' => 'Опыт (лет)',
            'key' => 'experience',
            'filter' => 'from_to',
            'field' => 'input',
            'field_type' => 'number',
            'attributes' => '',
        ], [
            'name' => 'Опыт онлайн (лет)',
            'key' => 'experience_online',
            'filter' => 'from_to',
            'field' => 'input',
            'field_type' => 'number',
            'attributes' => '',
        ], [
            'name' => 'Кол-во клиентов',
            'key' => 'clients',
            'filter' => 'from_to',
            'field' => 'input',
            'field_type' => 'number',
            'attributes' => '',
        ], [
            'name' => 'Проходите ли вы личную психотерапию?',
            'key' => 'psychotherapy',
            'filter' => 'checkbox',
            'field' => 'input',
            'field_type' => 'checkbox',
            'attributes' => '',
        ], [
            'name' => 'Проходите ли вы регулярные супервизии?',
            'key' => 'supervision',
            'filter' => 'checkbox',
            'field' => 'input',
            'field_type' => 'checkbox',
            'attributes' => '',
        ], [
            'name' => 'Имя супервизора',
            'key' => 'supervisor',
            'filter' => 'input',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'Самая длительная терапия',
            'key' => 'longest_consultation',
            'filter' => 'input',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'О себе',
            'key' => 'about',
            'filter' => 'input',
            'field' => 'textarea',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'Есть ли другая работа',
            'key' => 'other_work',
            'filter' => 'input',
            'field' => 'textarea',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'skype',
            'key' => 'skype',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'discord',
            'key' => 'discord',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'hangouts',
            'key' => 'hangouts',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ], [
            'name' => 'Включен (прошел модерацию)?',
            'key' => 'published',
            'filter' => 'checkbox',
            'field' => 'input',
            'field_type' => 'checkbox',
            'attributes' => '',
        ], [
            'name' => 'Ведет прием (настраивает сам пользователь)?',
            'key' => 'enabled',
            'filter' => 'checkbox',
            'field' => 'input',
            'field_type' => 'checkbox',
            'attributes' => '',
        ],[
            'name' => 'Название банка',
            'key' => 'bank_name',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ],[
            'name' => 'Номер карты',
            'key' => 'bank_account',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ],[
            'name' => 'Имя, фамилия на латинице',
            'key' => 'bank_holder',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ],[
            'name' => 'Срок действия карты',
            'key' => 'bank_date',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => '',
        ],
    ],
    'direction_fields' => [
        [
            'name' => 'Имя',
            'key' => 'name',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => 'required',
        ]
    ],
    'message_fields' => [
        [
            'name' => 'Заголовок',
            'key' => 'title',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'Содержимое',
            'key' => 'content',
            'filter' => 'like',
            'field' => 'textarea',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'Прочитано?',
            'key' => 'read',
            'filter' => 'checkbox',
            'field' => 'input',
            'field_type' => 'checkbox',
            'attributes' => '',
        ]
    ],

    'promocode_fields' => [
        [
            'name' => 'Код',
            'key' => 'code',
            'filter' => 'like',
            'field' => 'input',
            'field_type' => 'text',
            'attributes' => 'required',
        ], [
            'name' => 'Тип',
            'key' => 'type',
            'filter' => 'select',
            'field' => 'select',
            'attributes' => 'required',
            'values' => config('app.promocode_types'),
        ], [
            'name' => 'Значение',
            'key' => 'value',
            'filter' => 'from_to',
            'field' => 'input',
            'field_type' => 'number',
            'attributes' => 'required',
        ],
    ]
];
