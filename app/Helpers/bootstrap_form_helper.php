<?php

if (! function_exists('bs_form_group')) {
    function bs_form_group(string $name, string $label, string $type = 'text', ?string $value = '', string $placeholder = '', string $icon = '', bool $required = true): string
    {
        $value = $value ?? '';
        $iconHtml = $icon !== '' ? '<span class="input-group-text"><i class="fa ' . (str_starts_with($icon, 'fa-') ? esc($icon) : 'fa-' . esc($icon)) . '"></i></span>' : '';
        $requiredAttr = $required ? 'required' : '';

        return '
            <div class="mb-3">
                <label for="' . esc($name) . '" class="form-label fw-semibold">' . esc($label) . '</label>
                <div class="input-group">
                    ' . $iconHtml . '
                    <input type="' . esc($type) . '" name="' . esc($name) . '" id="' . esc($name) . '" class="form-control" placeholder="' . esc($placeholder) . '" value="' . esc($value) . '" ' . $requiredAttr . '>
                </div>
            </div>
        ';
    }
}

if (! function_exists('bs_password_group')) {
    function bs_password_group(string $name, string $label, string $placeholder = ''): string
    {
        $inputId = $name . '_field';

        return '
            <div class="mb-3">
                <label for="' . esc($inputId) . '" class="form-label fw-semibold">' . esc($label) . '</label>
                <div class="input-group">
                    <input type="password" name="' . esc($name) . '" id="' . esc($inputId) . '" class="form-control js-password-field" placeholder="' . esc($placeholder) . '" required>
                    <button type="button" class="btn btn-outline-secondary js-password-toggle" data-target="#' . esc($inputId) . '">Show</button>
                </div>
            </div>
        ';
    }
}

if (! function_exists('bs_select_group')) {
    function bs_select_group(string $name, string $label, array $options, string $placeholder = '-- Select --', bool $multiple = false, string $selected = '', bool $required = true): string
    {
        $multipleAttr = $multiple ? ' multiple' : '';
        $nameAttr = $multiple ? $name . '[]' : $name;
        $requiredAttr = $required ? ' required' : '';

        $html = '
            <div class="mb-3">
                <label for="' . esc($name) . '" class="form-label fw-semibold">' . esc($label) . '</label>
                <select name="' . esc($nameAttr) . '" id="' . esc($name) . '" class="form-select js-select2"' . $multipleAttr . $requiredAttr . '>
                    <option value="" disabled' . ($multiple ? '' : ' selected') . '>' . esc($placeholder) . '</option>
        ';

        foreach ($options as $optionValue => $optionLabel) {
            $isSelected = (string) $optionValue === (string) $selected ? ' selected' : '';
            $html .= '<option value="' . esc($optionValue) . '"' . $isSelected . '>' . esc($optionLabel) . '</option>';
        }

        $html .= '
                </select>
            </div>
        ';

        return $html;
    }
}
