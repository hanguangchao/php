<?php

namespace Algo\linkedlist;
require_once '../vendor/autoload.php';

$SimpleLinkedList = new SimpleLinkedList();
$SimpleLinkedList->add(1);
$SimpleLinkedList->add(2);
$SimpleLinkedList->add(3);
$SimpleLinkedList->add(4);
$SimpleLinkedList->add(5);
var_dump($SimpleLinkedList);

$SimpleLinkedList->list();


$n1 = new SimpleLinkedListNode(1);
$n2 = new SimpleLinkedListNode(2);
$n3 = new SimpleLinkedListNode(3);
$n4 = new SimpleLinkedListNode(4);
$n5 = new SimpleLinkedListNode(5);

$sll = new SimpleLinkedList();
$sll->addNodeAfter($sll->head, $n1);
$sll->addNodeAfter($n1, $n2);
$sll->addNodeAfter($n2, $n3);
$sll->addNodeAfter($n3, $n4);
$sll->addNodeAfter($n4, $n5);
$sll->list();
$sll->removeNode($n3);
$sll->removeNode($n4);
echo $sll->length();
$sll->list();
print_r($sll);