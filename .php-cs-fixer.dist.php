<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('vendor')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@PSR2' => true,
        '@PSR12' => true,
        'linebreak_after_opening_tag' => true,
        'non_printable_character' => true,
        'ordered_imports' => ['sortAlgorithm' => 'alpha'],
        'dir_constant' => true,
        'no_useless_else' => true,
        'visibility_required' => ['elements' => ['property', 'method', 'const']],
        'no_unused_imports' => true,
        'void_return' => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'array_syntax' => ['syntax' => 'short'],
        'declare_strict_types' => true,
        'fully_qualified_strict_types' => true,
        'function_to_constant' => true,
        'is_null' => true,
        'no_extra_blank_lines' => true,
        'no_extra_consecutive_blank_lines' => true,
        'no_leading_import_slash' => true,
        'no_null_property_initialization' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unneeded_curly_braces' => true,
        'php_unit_expectation' => true,
        'static_lambda' => true,
        'blank_line_after_opening_tag' => true,
        'strict_comparison' => true,
        'strict_param' => true,
    ])
    ->setFinder($finder)
;
