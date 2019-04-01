<?php
/*
https://leetcode.com/problems/longest-palindromic-substring/

Given a string s, find the longest palindromic substring in s. You may assume that the maximum length of s is 1000.

Example 1:

Input: "babad"
Output: "bab"
Note: "aba" is also a valid answer.
Example 2:

Input: "cbbd"
Output: "bb"s
 */
class Solution
{

    /**
     * @param String $s
     * @return String
     */

    public $result = '';
    public $str = '';

    public function longestPalindrome($s)
    {

        $this->str = $s;
        $n = strlen($s);
        if ($n < 1) {return '';}
        for ($i = 0; $i < $n; $i++) {
            $this->isPolindrome($i, $i);
            $this->isPolindrome($i, $i + 1);
        }
        return $this->result;
    }

    private function isPolindrome($l, $r)
    {
        $s = $this->str;
        echo '$l = ' . $l . PHP_EOL;
        while ($l >= 0 && $r < strlen($s) && $s[$l] === $s[$r]) {
            $polindrome = substr($s, $l, $r - $l + 1);
            $n = strlen($polindrome);
            if ($n > 0 && $n > strlen($this->result)) {
                $this->result = $polindrome;
            }
            $l--;
            $r++;
            echo 'counter' . PHP_EOL;
        }
    }
}
