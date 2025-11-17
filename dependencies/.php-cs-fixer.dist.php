<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

// set directories should be fix
$directories = [
    'app',
    'config',
    'database',
    // 'lang',
    'routes',
    // 'tests',
];

$finder = Finder::create();
$config = new Config();

foreach ($directories as $directory) {
    $finder->in(__DIR__ . '/' . $directory);
}

// ignore laravel blade file
$finder->notName('*.blade.php');

$PSR12 = [
    'blank_line_after_opening_tag' => true,
    // 'braces' => ['allow_single_line_closure' => true],
    'compact_nullable_typehint' => true,
    'concat_space' => ['spacing' => 'one'],
    'declare_equal_normalize' => ['space' => 'none'],
    // 'function_typehint_space' => true,
    // 'new_with_parentheses' => true,
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
    ],
    'no_empty_statement' => true,
    'no_leading_import_slash' => true,
    'no_leading_namespace_whitespace' => true,
    'no_whitespace_in_blank_line' => true,
    'return_type_declaration' => ['space_before' => 'none'],
    'single_trait_insert_per_statement' => true,
];

return $config->setRules([
    '@PSR2' => true,
    '@Symfony' => true,
    'cast_spaces' => [
        'space' => 'none',
    ],
    'phpdoc_align' => [
        'tags' => ['method', 'property', 'return', 'throws', 'type', 'var'],
    ],
    'phpdoc_order' => true,
    'phpdoc_to_comment' => false,
    'ternary_to_null_coalescing' => true,
    'no_useless_else' => true,
    'no_useless_return' => true,
    'ordered_class_elements' => true,
    'array_syntax' => [
        'syntax' => 'short',
    ],
] + $PSR12)->setFinder($finder);
