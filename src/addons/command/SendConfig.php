<?php
// +----------------------------------------------------------------------
// | Bwsaas
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2020 http://www.buwangyun.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Gitee ( https://gitee.com/buwangyun/bwsaas )
// +----------------------------------------------------------------------
// | Author: buwangyun <hnlg666@163.com>
// +----------------------------------------------------------------------
// | Date: 2021-4-22 10:55:00
// +----------------------------------------------------------------------

namespace think\addons\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use think\facade\Env;

class SendConfig extends Command
{

    public function configure()
    {
        $this->setName('addons:config')
             ->setDescription('send config to config folder');
    }

    public function execute(Input $input, Output $output)
    {
        //获取默认配置文件
        $content = file_get_contents(root_path() . 'vendor/hnlg666/bwsaas-addons/src/config.php');

        $configPath = config_path() . '/';
        $configFile = $configPath . 'addons.php';


        //判断目录是否存在
        if (!file_exists($configPath)) {
            mkdir($configPath, 0755, true);
        }

        //判断文件是否存在
        if (is_file($configFile)) {
            throw new \InvalidArgumentException(sprintf('The config file "%s" already exists', $configFile));
        }

        if (false === file_put_contents($configFile, $content)) {
            throw new \RuntimeException(sprintf('The config file "%s" could not be written to "%s"', $configFile,$configPath));
        }

        $output->writeln('create addons config ok');
    }

}