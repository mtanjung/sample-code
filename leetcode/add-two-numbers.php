<?php
/*
https://leetcode.com/problems/add-two-numbers/

You are given two non-empty linked lists representing two non-negative integers. The digits are stored in reverse order and each of their nodes contain a single digit. Add the two numbers and return it as a linked list.

You may assume the two numbers do not contain any leading zero, except the number 0 itself.

Example:

Input: (2 -> 4 -> 3) + (5 -> 6 -> 4)
Output: 7 -> 0 -> 8
Explanation: 342 + 465 = 807.
 */

class ListNode
{
    public $val = 0;
    public $next = null;
    public function __construct($val)
    {
        $this->val = $val;
    }
}

class Solution
{
    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    public function addTwoNumbers($l1, $l2)
    {
        $result = new ListNode(0);
        $current = $result;
        $carry = 0;
        while (!is_null($l1) || !is_null($l2)) {
            $sum = $l1->val + $l2->val + $carry;
            $carry = floor($sum / 10);
            $current->next = new ListNode($sum % 10);
            $current = $current->next;
            $l1 = $l1->next;
            $l2 = $l2->next;
        }

        if ($carry > 0) {
            $current->next = new ListNode($carry);
        }

        return $result->next;
    }
}
