# Symfony Multiple Applications Support

複数アプリケーションを運用する Symfony2 Standard Edition プロジェクト（[詳しくはこちら](#Symfony Standard Edition で複数アプリケーションを運用する)）のコマンド実行を補助します。  
例えば`cache:clear`等のコマンドを、すべてのアプリケーション上で順次実行する事ができます。

## 使い方
Composer でインストールします。
```
$ php composer.phar require issei/multiple-apps-support:dev-master
```

`bin`ディレクトリに`console`と言う共通コンソールが生成されます。  
現在、`cache:clear`,`assets:install`,`assetic:dump`の3つをサポートしています。

## cache:clear

```
$ bin/console cache:clear --no-warmup --env=prod
> Excuting command on frontend...
> Clearing the cache for the prod environment with debug false
> Excuting command on api...
> Clearing the cache for the prod environment with debug false
```

すべて同じ引数＆オプションで実行されます。

## assets:install

```
$ bin/console assets:install --symlink
> Excuting command on frontend...
> Installing assets using the symlink option
> Installing assets for Symfony\Bundle\FrameworkBundle into web/frontend/bundles/framework
> Excuting command on api...
> Installing assets using the symlink option
> Installing assets for Symfony\Bundle\FrameworkBundle into web/api/bundles/framework
```

第1引数（デフォルト：**web**）に`/%kernel.name%`が付与されます。オプションは共通の物が使用されます。  
※`-watch`,`--force`,`--perod`オプションは使用できません。

## assetic:dump

```
$ bin/console assetic:install --env=prod --no-debug web
> Excuting command on frontend...
> Dumping all prod assets.
> Debug mode is off.
> 
> xx:xx:xx [file+] $(PROJECT_ROOT)/apps/frontend/../../web/frontend/css/xxxxxx.css
> xx:xx:xx [file+] $(PROJECT_ROOT)/apps/frontend/../../web/frontend/js/xxxxxx.js
> Excuting command on api...
> Dumping all prod assets.
> Debug mode is off.
> 
> xx:xx:xx [file+] $(PROJECT_ROOT)/apps/api/../../web/api/css/xxxxxx.css
> xx:xx:xx [file+] $(PROJECT_ROOT)/apps/api/../../web/api/js/xxxxxx.js
```

第1引数（デフォルト：**%assetic.write_to%**）が指定された場合のみ、`/%kernel.name%`が付与されます。オプションは共通の物が使用されます。

## Symfony Standard Edition で複数アプリケーションを運用する
```
PROJECT ROOT
|   
+---apps
|   |   autoload.php
|   |   bootstrap.php.cache
|   |   ...
|   |   
|   +---frontend
|   |   |   FrontendCache.php
|   |   |   FrontendKernel.php
|   |   |   console
|   |   |   ...
|   |   |   
|   |   +---cache
|   |   +---config 
|   |   +---logs
|   |   \---Resources
|   |               
|   +---api
|   |       ApiCache.php
|   |       ApiKernel.php
|   |       console
|   |       ...
|   |               
|   \---config
|           config.yml
|           parameters.yml
|           ...
|           
+---bin     
+---src                
\---web
    +---frontend
    |       .htaccess
    |       app.php
    |       app_dev.php
    |       ...
    |       
    \---api
            ...
```

複数のアプリケーション（例ではfrontend, api）のカーネル、コンフィギュレーション、キャッシュ等を固有のアプリケーション名を付けたディレクトリに入れ、`apps`内で管理します。※カーネルのクラス名は `Kernel`で終わる必要があります。  
`web`ディレクトリにもアプリケーション毎に、対応するアプリケーションのディレクトリ名でネストして下さい。

※このアーキテクチャの詳細は以下をご参照下さい。  
* <a href="http://jolicode.com/blog/multiple-applications-with-symfony2" target="_blank">Multiple applications with Symfony2</a>  
* <a href="http://docs.symfony.gr.jp/symfony2/cookbook/symfony1.html" target="_blank">symfony1 ユーザーのための Symfony2</a>
