<?php

/**
 * 数组转为xML
 * @param $var 数组
 * @param $type xml的根节点
 * @param $tag
 * 返回xml格式
 */

function array2xml($var, $type = 'root', $tag = '') {
	$ret = '';
	if (!is_int($type)) {
		if ($tag)
			return array2xml(array($tag => $var), 0, $type); else {
				$tag .= $type;
				$type = 0;
			}
	}
	$level = $type;
	$indent = str_repeat("\t", $level);
	if (!is_array($var)) {
		$ret .= $indent . '<' . $tag;
		$var = strval($var);
		if ($var == '') {
			$ret .= ' />';
		} else if (!preg_match('/[^0-9a-zA-Z@\._:\/-]/', $var)) {
			$ret .= '>' . $var . '</' . $tag . '>';
		} else {
			$ret .= "><![CDATA[{$var}]]></{$tag}>";
		}
		$ret .= "\n";
	} else if (!(is_array($var) && count($var) && (array_keys($var) !== range(0, sizeof($var) - 1))) && !empty($var)) {
		foreach ($var as $tmp)
			$ret .= array2xml($tmp, $level, $tag);
	} else {
		$ret .= $indent . '<' . $tag;
		if ($level == 0)
			$ret .= '';
		if (isset($var['@attributes'])) {
			foreach ($var['@attributes'] as $k => $v) {
				if (!is_array($v)) {
					$ret .= sprintf(' %s="%s"', $k, $v);
				}
			}
			unset($var['@attributes']);
		}
		$ret .= ">\n";
		foreach ($var as $key => $val) {
			$ret .= array2xml($val, $level + 1, $key);
		}
		$ret .= "{$indent}</{$tag}>\n";
	}
	return $ret;
}