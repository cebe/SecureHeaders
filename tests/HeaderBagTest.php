<?php

namespace Tests;

use Aidantwoods\SecureHeaders\HeaderBag;
use PHPUnit_Framework_TestCase;

class HeaderBagTest extends PHPUnit_Framework_TestCase
{
    public function testThatHeadersAreAvailableWhenPassingAnArrayOnInstantiation()
    {
        $headers = new HeaderBag(array(
            'Content-Type' => 'text/html',
            'Content-Length' => '123',
        ));

        $this->assertTrue($headers->has('Content-Type'));
        $this->assertTrue($headers->has('Content-Length'));
    }

    public function testInstantiationFromHeaderLines()
    {
        $headers = HeaderBag::fromHeaderLines(array(
            'Content-Type: text/html',
            'Content-Length: 123',
        ));

        $this->assertTrue($headers->has('Content-Type'));
        $this->assertTrue($headers->has('Content-Length'));
    }

    public function testCaseIsPreserved()
    {
        $headers = new HeaderBag(array(
            'CONtenT-TYpE' => 'text/html',
            'conTENT-lENGTH' => '123',
        ));

        $this->assertTrue($headers->has('content-type'));

        $export = array_map(function ($header) { return (string) $header; }, $headers->get());

        $this->assertCount(2, $export);
        $this->assertStringStartsWith('CONtenT-TYpE', $export[0]);
        $this->assertStringStartsWith('conTENT-lENGTH', $export[1]);
    }
}   
