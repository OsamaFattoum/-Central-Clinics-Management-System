<?php

return [

    'records' => 'سجلات',
    'record' => 'سجل',

    'btn_add_record' => 'اضافة سجل',

    'case_type' => 'الحالة',
    'value' => 'نتيجة الفحص',
    'measurement_unit' => 'وحدة القياس',
    'result' => 'حالة النتيجة',
    'reference_range' => 'نسبة النتيجة',
    'date' => 'تاريخ الفحص',
    'time' => 'وقت الفحص',

    'res_abnormal' => 'غير طبيعي',
    'res_normal' => 'طبيعي',
    'res_positive' => 'إيجابي',
    'res_negative' => 'سلبي',

    'no_value' => '-',
    'in_date' => 'بتاريخ',
    'no_records' => 'لا توجد سجلات متاحة',

    'start_date_gt_end_date' => 'التاريخ الاول يجب ان يكون اقل من التاريخ الثاني',
    'start_date' => 'من تاريخ',
    'end_date' => 'الى تاريخ',
    

    //validation
    'case_type.required' =>  'حقل الحالة مطلوب.',
    'case_type.exists' => 'قيمة الحالة غير صحيحة.',
    'measurement_unit.string' => 'حقل وحدة القياس يجب أن يكون نصاً.',
    'measurement_unit.max' => 'حقل وحدة القياس يجب أن لا يتجاوز 20 حرفاً.',
    'result.required' => 'حقل حالة النتيجة مطلوب.',
    'result.in' => 'قيمة حالة النتيجة يجب أن تكون غير طبيعي أو طبيعي أو إيجابي أو سلبي.',
    'reference_range.string' => 'حقل نسبة النتيجة يجب أن يكون نصاً.',
    'reference_range.max' => 'حقل نسبة النتيجة يجب أن لا يتجاوز 15 حرفاً.',
    'value.required' => 'حقل القيمة مطلوب.',
    'value.string' => 'حقل نتيجة الفحص يجب أن يكون نصاً.',
    'value.min' => 'حقل نتيجة الفحص يجب أن يحتوي على 5 أحرف على الأقل.',


];