# Installation wizard for October

The wizard installation is a recommended way to install October. It is simpler than the command-line installation and doesn't require any special skills.

1. Prepare a directory on your server that is empty. It can be a sub-directory, domain root or a sub-domain.
1. [Download the installer archive file](https://github.com/octobercms/install/archive/master.zip).
1. Unpack the installer archive to the prepared directory.
1. Grant writing permissions on the installation directory and all its subdirectories and files.
1. Navigate to the install.php script in your web browser.
1. Follow the installation instructions.

## Minimum System Requirements

October CMS has a few system requirements:

* PHP 5.4 or higher
* PDO PHP Extension
* cURL PHP Extension
* MCrypt PHP Extension
* ZipArchive PHP Library
* GD PHP Library

As of PHP 5.5, some OS distributions may require you to manually install the PHP JSON extension.
When using Ubuntu, this can be done via ``apt-get install php5-json``.


<div class="toolbar-item" data-calculate-width>
        <ul>
            <li class="icon preview with-tooltip">
                <a
                    href="<?= URL::to('/') ?>"
                    target="_blank"
                    title="<?= e(trans('backend::lang.tooltips.preview_website')) ?>">
                    <i class="icon-crosshairs"></i>
                </a>
            </li>
            <li class="highlight account">
                <a href="javascript:;" onclick="$.oc.layout.toggleAccountMenu(this)">
                    <img src="<?= $this->user->getAvatarThumb(50, ['extension' => 'png']) ?>">
                    <span class="hidden-xs">
                        <?= e($this->user->first_name.' '.$this->user->last_name) ?>
                    </span>
                </a>
                <div class="mainmenu-accountmenu">
                    <ul>
                        <?php foreach ($mySettings as $category => $items): ?>
                            <?php foreach ($items as $item): ?>
                                <li>
                                    <a href="<?= $item->url ?>">
                                        <?= e(trans($item->label)) ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                            <li class="divider"></li>
                        <?php endforeach ?>

                        <li>
                            <a href="<?= Backend::url('backend/auth/signout') ?>">
                                <?= e(trans('backend::lang.account.sign_out')) ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
