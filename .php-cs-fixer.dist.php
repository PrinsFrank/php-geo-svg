<?php
declare(strict_types=1);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12'                                 => true,
        'declare_strict_types'                   => true,
        'strict_param'                           => true,
        'psr_autoloading'                        => true,
        'visibility_required'                    => true,
        'elseif'                                 => true,
        'no_superfluous_elseif'                  => true,
        'no_useless_else'                        => true,
        'yoda_style'                             => true,
        'ordered_imports'                        => true,
        'no_unused_imports'                      => true,
        'single_line_after_imports'              => true,
        'php_unit_construct'                     => true,
        'php_unit_test_case_static_method_calls' => true,
        'php_unit_test_class_requires_covers'    => true,
        'align_multiline_comment'                => true,
        'no_superfluous_phpdoc_tags'             => true,
        'phpdoc_annotation_without_dot'          => true,
        'strict_comparison'                      => true,
        'no_extra_blank_lines'                   => true,
        'no_whitespace_in_blank_line'            => true,
        'single_blank_line_at_eof'               => true,
        'array_syntax'                           => ['syntax' => 'short'],
    ])
    ->setFinder(
        (PhpCsFixer\Finder::create())
            ->exclude('vendor')
            ->in(__DIR__)
    );
