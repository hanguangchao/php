<?php


namespace Algo\linkedlist;

class SimpleLinkedList
{
    private $length;
    public $head;

    public function __construct()
    {
        $this->head = new SimpleLinkedListNode();
        $this->length = 0;
    }

    public function add($data)
    {
        $this->addAfter($this->head, $data);
    }

    public function addAfter(SimpleLinkedListNode $curr, $data)
    {
        if (is_null($curr)) {
            return false;
        }

        $node = new SimpleLinkedListNode();
        $node->data = $data;
        $node->next = $curr->next;

        $curr->next = $node;
        $this->length++;
        return $node;
    }

    public function addNodeAfter(SimpleLinkedListNode $node, SimpleLinkedListNode $newnode)
    {
        $newnode->next = $node->next;
        $node->next = $newnode;
        $this->length++;
    }

    public function removeNode(SimpleLinkedListNode $node)
    {
        //找到当前节点的Pre
        $preNode = $this->getPreNode($node);
        //指向next节点
        $preNode->next = $node->next;
        unset($node);
        $this->length--;
        return true;
    }

    public function getPreNode(SimpleLinkedListNode $node)
    {
        $curNode = $this->head;
        $preNode = $this->head;
        while ($curNode !== $node && $curNode != null) {
            $preNode = $curNode;
            $curNode = $curNode->next;
        }
        return $preNode;
    }

    function list()
    {
        $curNode = $this->head;
        while ($curNode->next) {
            echo ($curNode->next->data) . ' -> ';
            $curNode = $curNode->next;
        }
        echo 'NULL' . PHP_EOL;
    }

    public function length()
    {
        return $this->length;
    }
}

class SimpleLinkedListNode
{
    public $next = null;
    public $data = null;

    public function __construct($data = null)
    {
        $this->next = null;
        $this->data = $data;
    }
}

