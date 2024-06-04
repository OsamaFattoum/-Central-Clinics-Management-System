<?php

return [

    'medications' => 'ادوية',
    
    'medication' => 'دواء',

    'btn_add_medication' => 'اضافة دواء',


    'name' => 'اسم الدواء',
    'case_type' => 'نوع الحالة',
    'dosage' => 'حجم الجرعة',
    'instructions' => 'تعليمات',
    'medication_taken' => 'الحالة',
    'has_alternative' => 'بديل',

    'departments' => 'الاقسام',
    

    'date' => 'تاريخ الوصفة',
    'time' => 'وقت الوصفة',

    'dispensed' => 'تم صرفه',
    'undispensed' => 'فعال',
    
    'taken' => 'تم اخذه',
    'not_taken' => 'لم يأخذ',

    

    //validation
    'department.required' => 'يجب اختيار قسم الدواء',
    'department.exists' => 'هذا القسم غير موجود',
    'case_type.required' => 'يجب اختيار حالة',
    'case_type.exists' => 'هذه الحالة غير موجوده',
    'name.required' => 'حقل اسم الدواء مطلوب.',
    'name.string' => 'يجب أن يكون الاسم نصًا.',
    'name.min' => 'يجب أن يحتوي اسم الدواء على الأقل على :min أحرف.',
    'name.max' => 'لا يجب أن يتجاوز اسم الدواء :max أحرف.',
    'name.unique' => 'تم اختيار اسم الدواء مسبقًا.',
    'dosage.required' => 'حقل حجم الجرعة مطلوب.',
    'dosage.string' => 'يجب أن يكون حقل حجم الجرعة نصًا.',
    'dosage.max' => 'لا يجب أن يتجاوز حقل حجم الجرعة :max أحرف.',
    'instructions.required' => 'حقل التعليمات مطلوب.',
    'instructions.string' => 'يجب أن يكون حقل التعليمات نصًا.',
    'instructions.max' => 'لا يجب أن يتجاوز حقل التعليمات :max أحرف.',
    'medication_taken.required' => 'يجب اختيار الحالة',
    'has_alternative.required' => 'يجب اختيار حالة البديل',



];