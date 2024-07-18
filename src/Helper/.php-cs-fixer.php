<?php

/**
 * PHP CS Fixer
 *
 * (c) onceyoungs <onceyoungs@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

include_once 'vendor/autoload.php';

const SOFT_NAME   = 'The Api System';// software
const SOFT_AUTHOR = 'onceyoungs';// Team
const SOFT_TIME   = '2024';// date
const SOFT_URL    = 'https://www.yangqudaniu.cn';// email

$finder = PhpCsFixer\Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('vendor')
    ->in(__DIR__)
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$fixers = [
    '@PSR2'                                      => true,
    'single_quote'                               => true, //简单字符串应该使用单引号代替双引号；
    'no_unused_imports'                          => true, //删除没用到的use
    'no_singleline_whitespace_before_semicolons' => true, //禁止只有单行空格和分号的写法；
    'no_empty_statement'                         => true, //多余的分号
    'no_extra_blank_lines'                       => true, //多余空白行
    'no_blank_lines_after_phpdoc'                => true, //注释和代码中间不能有空行
    'no_empty_phpdoc'                            => true, //禁止空注释
    'phpdoc_indent'                              => true, //注释和代码的缩进相同
    'no_blank_lines_after_class_opening'         => true, //类开始标签后不应该有空白行；
    'include'                                    => true, //include 和文件路径之间需要有一个空格，文件路径不需要用括号括起来；
    'no_trailing_comma_in_singleline'            => true, //删除 list 语句中多余的逗号；
    'no_leading_namespace_whitespace'            => true, //命名空间前面不应该有空格；
    'standardize_not_equals'                     => true, //使用 <> 代替 !=；
    'blank_line_after_opening_tag'               => true, //PHP开始标记后换行
    'indentation_type'                           => true,
    'concat_space'                               => [
        'spacing' => 'one',
    ],
    'space_after_semicolon'                      => [
        'remove_in_empty_for_expressions' => true,
    ],
    'header_comment'                             => [
        'comment_type' => 'PHPDoc',
        'header'       => SOFT_NAME . " \r\n\r\n(c) " . SOFT_AUTHOR . " " . SOFT_TIME . " <" . SOFT_URL . "> \r\n\r\nThis is not a free software \r\nUsing it under the license terms\r\nvisited " . SOFT_URL . " for more details",
    ],
    'braces'                                     => ['position_after_functions_and_oop_constructs' => 'same'],
    'binary_operator_spaces'                     => [
        'operators' => [
            '=>' => 'align_single_space_minimal_by_scope',
            '='  => 'align_single_space_minimal'
        ]
    ], // 等号对齐、数字箭头符号对齐
    'ordered_imports'                            => [
        'imports_order'  => ['class', 'function', 'const'],
        'sort_algorithm' => 'alpha',
    ],// use排序
];
$config = new \PhpCsFixer\Config();
return $config
    ->setRules($fixers)
    ->setFinder($finder)
    ->setIndent('    ');
