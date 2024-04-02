<?php

return [
   'btn_create_clinic' => 'إضافة عيادة',
   

   'title_main_info' => 'المعلومات الاساسية',
   'name_clinic' => 'اسم العيادة',
   'name_clinic_ar' => 'اسم العياده بالعربيه',
   'name_clinic_en' => 'اسم العياده بالانجليزيه',
   'number_clinic' => 'الرقم الخاص لدخول',
   'password' => 'كلمة المرور',
   'password_confirmation' => 'تاكيد كلمة المرور',
   'email' => 'البريد الالكتروني',
   'open_days' => 'أيام العمل',
   'department' => 'الاقسام',
   'description' => 'الوصف',
   'description_ar' => 'الوصف بالعربيه',
   'description_en' => 'الوصف بالانجليزيه',
   'title_general_info' => 'المعلومات العامه',
   'address' => 'العنوان',
   'city' => 'المدينة',
   'postal_code' => 'الرقم البريدي',
   'phone' => 'رقم الهاتف',
   'open_hours' => 'وقت بدء الدوام',
   'close_hours' => 'وقت الاغلاق',
   'image' => 'صورة العيادة',
   'image_note' => 'صيغة الملف المطلوبه',

   'title_owner_info' => 'معلومات المالك',
   'owner_name' => 'الاسم',

   'edit_image' => 'تعديل الصورة',



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

   'departments.required' => 'حقل الاقسام مطلوب.',
   'departments.array' => 'يجب أن تكون الاقسام مصفوفة.',
   'departments.min' => 'يجب أن تحتوي الاقسام على الأقل :min عنصر.',

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



  
  
     
  
  
];
