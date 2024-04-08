<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | تحتوي السطور اللغوية التالية على رسائل الخطأ الافتراضية المستخدمة من قبل
    | فئة المحقق. بعض هذه القواعد لديها إصدارات متعددة مثل قواعد الحجم.
    | لا تتردد في تعديل كل هذه الرسائل هنا.
    |
    */

    //validation
    'name.ar.required' => 'حقل الاسم بالعربيه مطلوب.',
    'name.en.required' => 'حقل الاسم بالانجليزيه مطلوب.',
    'name.string' => 'يجب أن يكون الاسم نصًا.',
    'name.ar.min' => 'يجب أن يحتوي الاسم بالعربيه على الأقل على :min أحرف.',
    'name.en.min' => 'يجب أن يحتوي الاسم بالانجليزيه على الأقل على :min أحرف.',
    'name.ar.max' => 'لا يجب أن يتجاوز الاسم بالعربيه :max أحرف.',
    'name.en.max' => 'لا يجب أن يتجاوز الاسم بالانجليزيه :max أحرف.',
    'name.ar.unique' => 'تم اختيار هذا الاسم بالعربيه مسبقًا.',
    'name.en.unique' => 'تم اختيار هذا الاسم بالانجليزيه مسبقًا.',

    'number.required' => 'حقل الرقم مطلوب.',
    'number.regex' => 'يجب ان يحتوي حقل الرقم الخاص على ارقام فقط',
    'number.string' => 'حقل الرقم يجب أن يكون نصًا.',
    'number.min' => 'حقل الرقم يجب أن يكون :min أرقام.',
    'number.max' => 'حقل الرقم يجب أن يكون :max أرقام.',
    'number.unique' => 'حقل الرقم موجود مسبقًا.',

    'email.required' => 'حقل البريد الإلكتروني مطلوب.',
    'email.email' => 'البريد الإلكتروني يجب أن يكون بتنسيق صحيح.',
    'email.unique' => 'البريد الإلكتروني موجود مسبقًا.',

    'password.required' => 'حقل كلمة المرور مطلوب.',
    'password.string' => 'حقل كلمة المرور يجب أن يكون نصًا.',
    'password.min' => 'كلمة المرور يجب أن تتكون من :min أحرف على الأقل.',
    'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
    'password_confirmation.required' => 'حقل تأكيد كلمة المرور مطلوب.',



    'days.required' => 'حقل أيام العمل مطلوب.',
    'days.array' => 'يجب أن تكون أيام العمل مصفوفة.',
    'days.min' => 'يجب أن تحتوي أيام العمل على الأقل :min عنصر.',

    'address.required' => 'حقل العنوان مطلوب.',
    'address.min' => 'يجب أن يحتوي العنوان على الأقل :min أحرف.',
    'address.string' => 'يجب أن يكون العنوان نصًا.',

    'city.required' => 'حقل المدينة مطلوب.',
    'city.in' => 'حقل المدينة يجب ان يكون صالح.',

    'postal_code.required' => 'حقل الرقم البريدي مطلوب.',
    'postal_code.min' => 'يجب أن يحتوي الرقم البريدي على الأقل :min من الارقام.',
    'postal_code.max' => 'يجب ألا يتجاوز الرقم البريدي عدد الارقام :max.',
    'postal_code.string' => 'يجب أن يكون الرقم البريدي نصًا.',
    'postal_code.regex' => 'يجب ان يحتوي حقل الرقم البريدي على ارقام فقط',

    'phone.required' => 'حقل رقم الهاتف مطلوب.',
    'phone.min' => 'يجب أن يحتوي رقم الهاتف على الأقل :min أحرف.',
    'phone.max' => 'يجب ألا يتجاوز رقم الهاتف عدد الارقام :max.',
    'phone.string' => 'يجب أن يكون رقم الهاتف نصًا.',
    'phone.regex' => 'يجب ان يكون رقم الهاتف صالح',

    'open_hours.required' => 'حقل وقت بدء الدوام مطلوب.',
    'open_hours.date_format' => 'صيغة وقت بدء الدوام غير صحيحة.',

    'close_hours.required' => 'حقل وقت الإغلاق مطلوب.',
    'close_hours.date_format' => 'صيغة وقت الإغلاق غير صحيحة.',

    'image.image' => 'يجب أن يكون الملف ملف صورة.',
    'image.max' => 'يجب ألا يتجاوز حجم الصورة :max كيلوبايت.',

    'owner_name.required' => 'حقل اسم المالك مطلوب.',
    'owner_name.min' => 'يجب أن يحتوي اسم المالك على الأقل :min أحرف.',
    'owner_name.max' => 'يجب ألا يتجاوز اسم المالك عدد الحروف :max.',
    'owner_name.string' => 'يجب أن يكون اسم المالك نصًا.',

    'owner_phone.required' => 'حقل هاتف المالك مطلوب.',
    'owner_phone.min' => 'يجب أن يحتوي هاتف المالك على الأقل :min من الارقام.',
    'owner_phone.max' => 'يجب ألا يتجاوز هاتف المالك عدد الارقام :max.',
    'owner_phone.string' => 'يجب أن يكون هاتف المالك نصًا.',

    'owner_email.required' => 'حقل بريد المالك مطلوب.',
    'owner_email.email' => 'يجب أن يكون بريد المالك عنوانًا صحيحًا.',

    'departments.required' => 'حقل الاقسام مطلوب.',
    'departments.array' => 'يجب أن تكون الاقسام مصفوفة.',
    'departments.min' => 'يجب أن تحتوي الاقسام على الأقل :min عنصر.',

    'civil_id.required' => 'حقل الرقم الوطني مطلوب.',
    'civil_id.string' => 'يجب أن يكون الرقم الوطني نصًا.',
    'civil_id.min' => 'يجب أن يحتوي الرقم الوطني على الأقل :min من الارقام.',
    'civil_id.max' => 'يجب ألا يتجاوز الرقم الوطني عدد الارقام :max.',

    
    'accepted' => 'يجب قبول :attribute.',
    'active_url' => ':attribute ليس عنوان URL صحيح.',
    'after' => ':attribute يجب أن يكون تاريخًا بعد :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخًا بعد أو يساوي :date.',
    'alpha' => ':attribute يجب أن يحتوي على أحرف فقط.',
    'alpha_dash' => ':attribute يجب أن يحتوي على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
    'alpha_num' => ':attribute يجب أن يحتوي على أحرف وأرقام فقط.',
    'array' => ':attribute يجب أن يكون مصفوفة.',
    'before' => ':attribute يجب أن يكون تاريخًا قبل :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخًا قبل أو يساوي :date.',
    'between' => [
        'numeric' => ':attribute يجب أن يكون بين :min و :max.',
        'file' => ':attribute يجب أن يكون بين :min و :max كيلوبايت.',
        'string' => ':attribute يجب أن يكون بين :min و :max حرفًا.',
        'array' => ':attribute يجب أن يحتوي على بين :min و :max عنصر.',
    ],
    'boolean' => 'يجب أن يكون حقل :attribute صحيحًا أو خاطئًا.',
    'confirmed' => 'تأكيد :attribute غير متطابق.',
    'date' => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals' => ':attribute يجب أن يكون تاريخًا يساوي :date.',
    'date_format' => ':attribute لا يتناسب مع التنسيق :format.',
    'different' => ':attribute و :other يجب أن يكونوا مختلفين.',
    'digits' => ':attribute يجب أن يكون :digits أرقام.',
    'digits_between' => ':attribute يجب أن يكون بين :min و :max أرقام.',
    'dimensions' => ':attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'حقل :attribute يحتوي على قيمة مكررة.',
    'email' => ':attribute يجب أن يكون عنوان بريد إلكتروني صحيح.',
    'ends_with' => ':attribute يجب أن ينتهي بأحد القيم التالية: :values.',
    'exists' => ':attribute المحدد غير صحيح.',
    'file' => ':attribute يجب أن يكون ملفًا.',
    'filled' => 'يجب أن يحتوي حقل :attribute على قيمة.',
    'gt' => [
        'numeric' => ':attribute يجب أن يكون أكبر من :value.',
        'file' => ':attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أكبر من :value حرفًا.',
        'array' => ':attribute يجب أن يحتوي على أكثر من :value عنصر.',
    ],
    'gte' => [
        'numeric' => ':attribute يجب أن يكون أكبر من أو يساوي :value.',
        'file' => ':attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أكبر من أو يساوي :value حرفًا.',
        'array' => ':attribute يجب أن يحتوي على :value عنصر أو أكثر.',
    ],
    'image' => ':attribute يجب أن يكون صورة.',
    'in' => ':attribute المحدد غير صحيح.',
    'in_array' => 'حقل :attribute غير موجود في :other.',
    'integer' => ':attribute يجب أن يكون عددًا صحيحًا.',
    'ip' => ':attribute يجب أن يكون عنوان IP صحيحًا.',
    'ipv4' => ':attribute يجب أن يكون عنوان IPv4 صحيحًا.',
    'ipv6' => ':attribute يجب أن يكون عنوان IPv6 صحيحًا.',
    'json' => ':attribute يجب أن يكون سلسلة JSON صحيحة.',
    'lt' => [
        'numeric' => ':attribute يجب أن يكون أقل من :value.',
        'file' => ':attribute يجب أن يكون أقل من :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أقل من :value حرفًا.',
        'array' => ':attribute يجب أن يحتوي على أقل من :value عنصر.',
    ],
    'lte' => [
        'numeric' => ':attribute يجب أن يكون أقل من أو يساوي :value.',
        'file' => ':attribute يجب أن يكون أقل من أو يساوي :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أقل من أو يساوي :value حرفًا.',
        'array' => ':attribute يجب أن لا يحتوي على أكثر من :value عنصر.',
    ],
    'max' => [
        'numeric' => ':attribute يجب أن لا يكون أكبر من :max.',
        'file' => ':attribute يجب أن لا يكون أكبر من :max كيلوبايت.',
        'string' => ':attribute يجب أن لا يكون أكبر من :max حرفًا.',
        'array' => ':attribute يجب أن لا يحتوي على أكثر من :max عنصر.',
    ],
    'mimes' => ':attribute يجب أن يكون ملفًا من النوع: :values.',
    'mimetypes' => ':attribute يجب أن يكون ملفًا من النوع: :values.',
    'min' => [
        'numeric' => ':attribute يجب أن يكون على الأقل :min.',
        'file' => ':attribute يجب أن يكون على الأقل :min كيلوبايت.',
        'string' => ':attribute يجب أن يكون على الأقل :min حرفًا.',
        'array' => ':attribute يجب أن يحتوي على على الأقل :min عنصر.',
    ],
    'multiple_of' => ':attribute يجب أن يكون مضاعفًا للقيمة :value.',
    'not_in' => ':attribute المحدد غير صحيح.',
    'not_regex' => 'تنسيق :attribute غير صحيح.',
    'numeric' => ':attribute يجب أن يكون رقمًا.',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب أن يكون حقل :attribute موجودًا.',
    'regex' => 'تنسيق :attribute غير صحيح.',
    'required' => 'حقل :attribute مطلوب.',
    'required_if' => 'يجب أن يكون حقل :attribute مطلوبًا عندما يكون :other هو :value.',
    'required_unless' => 'يجب أن يكون حقل :attribute مطلوبًا ما لم يكن :other في :values.',
    'required_with' => 'يجب أن يكون حقل :attribute مطلوبًا عندما يكون :values موجودًا.',
    'required_with_all' => 'يجب أن يكون حقل :attribute مطلوبًا عندما تكون :values موجودة.',
    'required_without' => 'يجب أن يكون حقل :attribute مطلوبًا عندما لا يكون :values موجودًا.',
    'required_without_all' => 'يجب أن يكون حقل :attribute مطلوبًا عندما لا تكون :values موجودة.',
    'prohibited' => 'حقل :attribute ممنوع.',
    'prohibited_if' => 'حقل :attribute ممنوع عندما يكون :other هو :value.',
    'prohibited_unless' => 'حقل :attribute ممنوع ما لم يكن :other في :values.',
    'same' => ':attribute و :other يجب أن يتطابقوا.',
    'size' => [
        'numeric' => ':attribute يجب أن يكون :size.',
        'file' => ':attribute يجب أن يكون :size كيلوبايت.',
        'string' => ':attribute يجب أن يكون :size حرفًا.',
        'array' => ':attribute يجب أن يحتوي على :size عنصر.',
    ],
    'starts_with' => ':attribute يجب أن يبدأ بأحد القيم التالية: :values.',
    'string' => ':attribute يجب أن يكون نصًا.',
    'timezone' => ':attribute يجب أن يكون منطقة زمنية صحيحة.',
    'unique' => ':attribute تم اتخاذه بالفعل.',
    'uploaded' => 'فشل في تحميل :attribute.',
    'url' => 'تنسيق :attribute غير صحيح.',
    'uuid' => ':attribute يجب أن يكون UUID صحيح.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
