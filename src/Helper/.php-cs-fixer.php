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
const SOFT_AUTHOR = 'onceyoungs';// onceyoungs Team
const SOFT_TIME   = '2024';// date
const SOFT_URL    = 'https://www.yangqudaniu.cn';// onceyoungs@163.com

$finder = PhpCsFixer\Finder::create()
	->files()
	->name('*.php')
	->exclude('vendor')
	->in(__DIR__)
	->ignoreDotFiles(true)
	->ignoreVCS(true);

$fixers = array(
	'@PSR2'                                      => true,
	'single_quote'                               => true, //简单字符串应该使用单引号代替双引号；
	'no_unused_imports'                          => true, //删除没用到的use
	'no_singleline_whitespace_before_semicolons' => true, //禁止只有单行空格和分号的写法；
	'no_empty_statement'                         => true, //多余的分号
	'no_extra_consecutive_blank_lines'           => true, //多余空白行
	'no_blank_lines_after_class_opening'         => true, //类开始标签后不应该有空白行；
	'include'                                    => true, //include 和文件路径之间需要有一个空格，文件路径不需要用括号括起来；
	'no_trailing_comma_in_list_call'             => true, //删除 list 语句中多余的逗号；
	'no_leading_namespace_whitespace'            => true, //命名空间前面不应该有空格；
	'standardize_not_equals'                     => true, //使用 <> 代替 !=；
	'blank_line_after_opening_tag'               => true, //PHP开始标记后换行
	'indentation_type'                           => true,
	'header_comment' => [
	    'comment_type' => 'PHPDoc',
	    'header'       => SOFT_NAME . " \r\n\r\n(c) " . SOFT_AUTHOR . " " . SOFT_TIME . " <" . SOFT_URL . "> \r\n\r\nThis is not a free software \r\nUsing it under the license terms\r\nvisited " . SOFT_URL . " for more details",
    ],
	'braces'                                     => ['position_after_functions_and_oop_constructs' => 'same'], //设置大括号换行，暂时根本Psr
	//'binary_operator_spaces'                   => ['default' => 'align_single_space'], //等号对齐、数字箭头符号对齐
);
return PhpCsFixer\Config::create()
	->setRules($fixers)
	->setFinder($finder)
	->setIndent('    ')
	->setUsingCache(false);
