<?php
/*
https://leetcode.com/problems/longest-substring-without-repeating-characters/

Given a string, find the length of the longest substring without repeating characters.

Example 1:

Input: "abcabcbb"
Output: 3
Explanation: The answer is "abc", with the length of 3.
Example 2:

Input: "bbbbb"
Output: 1
Explanation: The answer is "b", with the length of 1.
Example 3:

Input: "pwwkew"
Output: 3
Explanation: The answer is "wke", with the length of 3.
Note that the answer must be a substring, "pwke" is a subsequence and not a substring.
 */
class Solution
{

    /**
     * @param String $s
     * @return Integer
     */
    public function lengthOfLongestSubstring($s)
    {

        $pastChars = [];
        $sLen = strlen($s);
        $prevChar = null;
        $currChar = null;
        $longest = 0;
        $currentLongest = 0;

        for ($i = 0; $i < $sLen; $i++) {

            $currChar = $s[$i];

            if ($currChar == $prevChar) {
                $currentLongest = 1;
                $pastChars = [];
            } elseif (in_array($s[$i], $pastChars)) {

                // Find array key of the duplicate
                $dupKey = array_search($s[$i], $pastChars);
                // Remove all elements from index 0 up to index of the dup value
                $pastChars = array_slice($pastChars, $dupKey + 1);
                $currentLongest = count($pastChars) + 1;
            } else {
                $currentLongest++;
            }

            if ($currentLongest > $longest) {
                $longest = $currentLongest;
            }

            $prevChar = $currChar;
            $pastChars[] = $currChar;
        }

        return $longest;
    }
}
