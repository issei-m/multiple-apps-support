# Symfony Multiple Applications Support

�����A�v���P�[�V�������^�p���� Symfony2 Standard Edition �v���W�F�N�g�i[�ڂ����͂�����](#symfony-standard-edition-%E3%81%A7%E8%A4%87%E6%95%B0%E3%82%A2%E3%83%97%E3%83%AA%E3%82%B1%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%82%92%E9%81%8B%E7%94%A8%E3%81%99%E3%82%8B)�j�̃R�}���h���s��⏕���܂��B  
�Ⴆ��`cache:clear`���̃R�}���h���A���ׂẴA�v���P�[�V������ŏ������s���鎖���ł��܂��B

## �g����
Composer �ŃC���X�g�[�����܂��B
```
$ php composer.phar require issei/multiple-apps-support:dev-master
```

`bin`�f�B���N�g����`console`�ƌ������ʃR���\�[������������܂��B  
���݁A`cache:clear`,`assets:install`,`assetic:dump`��3���T�|�[�g���Ă��܂��B

## cache:clear

```
$ bin/console cache:clear --no-warmup --env=prod
> Excuting command on frontend...
> Clearing the cache for the prod environment with debug false
> Excuting command on api...
> Clearing the cache for the prod environment with debug false
```

���ׂē����������I�v�V�����Ŏ��s����܂��B

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

��1�����i�f�t�H���g�Fweb�j��`/%kernel.name%`���t�^����܂��B�I�v�V�����͋��ʂ̕����g�p����܂��B  
��`-watch`,`--force`,`--perod`�I�v�V�����͎g�p�ł��܂���B

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

��1�����i�f�t�H���g�F%assetic.write_to%�j���w�肳�ꂽ�ꍇ�̂݁A`/%kernel.name%`���t�^����܂��B�I�v�V�����͋��ʂ̕����g�p����܂��B

## Symfony Standard Edition �ŕ����A�v���P�[�V�������^�p����
```
PROJECT ROOT
|   
+---apps <------------------------ �����ɕ����̃A�v���P�[�V�������i�[�B
|   |   autoload.php               autoload.php, bootstrap.php.cache ���̋��L�t�@�C���̓��[�g�ɔz�u�B
|   |   bootstrap.php.cache 
|   |   ...
|   |   
|   +---frontend <---------------- �A�v���P�[�V�������[�g�B�f�B���N�g�������A�v���P�[�V�������ƂȂ�B
|   |   |   FrontendCache.php  <-- �A�v���P�[�V�����L���b�V���B
|   |   |   FrontendKernel.php <-- �A�v���P�[�V�����J�[�l���B�N���X���� `Kernel` �ŏI���K�v������B
|   |   |   console <------------- �A�v���P�[�V�����R���\�[��
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
|   \---config <------------------ �v���W�F�N�g���L�̃R���t�B�M�����[�V�����B�A�v���P�[�V������import���Ďg���B
|           config.yml
|           parameters.yml
|           ...
|           
+---bin     
+---src                
\---web
    +---frontend <---------------- �A�v���P�[�V�������J�f�B���N�g���B�f�B���N�g�����̓A�v���P�[�V�����Ɠ��l�B
    |       .htaccess
    |       app.php
    |       app_dev.php
    |       ...
    |       
    \---api
            ...
```

�����̃A�v���P�[�V�����i��ł�frontend, api�j�̃J�[�l���A�R���t�B�M�����[�V�����A�L���b�V�������ŗL�̃A�v���P�[�V��������t�����f�B���N�g���ɓ���A`apps`���ŊǗ����܂��B  
`web`�f�B���N�g���ɂ��A�v���P�[�V�������ɁA�Ή�����A�v���P�[�V�����̃f�B���N�g�����Ńl�X�g���ĉ������B

�����̃A�[�L�e�N�`���̏ڍׂ͈ȉ������Q�Ɖ������B  
* <a href="http://jolicode.com/blog/multiple-applications-with-symfony2" target="_blank">Multiple applications with Symfony2</a>  
* <a href="http://docs.symfony.gr.jp/symfony2/cookbook/symfony1.html" target="_blank">symfony1 ���[�U�[�̂��߂� Symfony2</a>
