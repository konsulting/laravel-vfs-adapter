<?php

namespace League\Flysystem\Adapter
{
    function file_put_contents($name)
    {
        if (str_contains($name, 'pleasefail')) {
            return false;
        }
        return file_put_contents(...func_get_args());
    }
    function file_get_contents($name)
    {
        if (str_contains($name, 'pleasefail')) {
            return false;
        }
        return file_get_contents(...func_get_args());
    }
}

namespace STS\Filesystem
{
    use League\Flysystem\Config;
    use PHPUnit\Framework\TestCase;

    class FailTests extends TestCase
    {
        /** @test */
        public function ensure_we_fail_on_all_of_these()
        {
            $adapter = new VirtualFilesystemAdapter();
            $this->assertFalse($adapter->write('pleasefail.txt', 'content', new Config()));
            $this->assertFalse($adapter->write('pleasefail.txt', 'content', new Config()));
            $this->assertFalse($adapter->read('pleasefail.txt'));
            $this->assertFalse($adapter->deleteDir('non-existing'));
        }
    }
}
