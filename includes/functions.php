<?php

function gs_wp_kses($content) {

    $allowed_tags = wp_kses_allowed_html('post');

    $input_common_atts = ['class' => true, 'id' => true, 'style' => true, 'novalidate' => true, 'name' => true, 'width' => true, 'height' => true, 'data' => true, 'title' => true, 'placeholder' => true, 'value' => true];

    $allowed_tags = array_merge_recursive($allowed_tags, [
        'select' => $input_common_atts,
        'input' => array_merge($input_common_atts, ['type' => true, 'checked' => true]),
        'option' => ['class' => true, 'id' => true, 'selected' => true, 'data' => true, 'value' => true]
    ]);

    return wp_kses(stripslashes_deep($content), $allowed_tags);
}

function select_builder($name, $options, $selected = "", $selecttext = "", $class = "", $optionvalue = 'value') {

    if (is_array($options)) {

        $select_html = sprintf('<select name="%1$s" id="%1$s" class="%2$s">', esc_attr($name), esc_attr($class));

        if ($selecttext) $select_html .= sprintf('<option value="">%s</option>', esc_html($selecttext));

        foreach ($options as $key => $option) {
            $value = $optionvalue == 'value' ? $option : $key;
            $is_selected = $value == $selected ? 'selected="selected"' : '';
            $select_html .= sprintf('<option value="%s" %s>%s</option>', esc_attr($value), $is_selected, esc_html($option));
        }

        $select_html .= '</select>';
        echo gs_wp_kses($select_html);
    }
}













function vd( $data ){
    echo '<pre>';
    var_dump(  $data );
    echo '</pre>';
    exit();
}