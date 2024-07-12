<?php

return [

    'records' => 'Records',
    'record' => 'Record',

    'btn_add_record' => 'Add Record',

    'case_type' => 'Case Type',
    'value' => 'Test Result',
    'measurement_unit' => 'Measurement Unit',
    'result' => 'Result Status',
    'reference_range' => 'Reference Range',
    'date' => 'Date of Test',
    'time' => 'Time of Test',

    'res_abnormal' => 'Abnormal',
    'res_normal' => 'Normal',
    'res_positive' => 'Positive',
    'res_negative' => 'Negative',

    'no_value' => '-',
    'in_date' => 'On Date',
    'no_records' => 'No records available',

    'start_date_gt_end_date' => 'Start date must be before end date',
    'start_date' => 'From Date',
    'end_date' => 'To Date',
    'clear_history' => 'Clear Search',


    // Validation
    'case_type.required' => 'Case type is required.',
    'case_type.exists' => 'This case type does not exist.',
    'measurement_unit.string' => 'Measurement unit must be a string.',
    'measurement_unit.max' => 'Measurement unit must not exceed 20 characters.',
    'result.required' => 'Result status is required.',
    'result.in' => 'Result status must be Abnormal, Normal, Positive, or Negative.',
    'reference_range.string' => 'Reference range must be a string.',
    'reference_range.max' => 'Reference range must not exceed 15 characters.',
    'value.required' => 'Test result value is required.',
    'value.string' => 'Test result value must be a string.',
    'value.min' => 'Test result value must be at least 5 characters long.',


];
