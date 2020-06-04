<?php
namespace TeamDigital\Tdtemplate\Command;

use TYPO3\CMS\Core\Log\Logger;
use TYPO3\CMS\Core\Log\LogLevel;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;

use TYPO3\CMS\Core\Core\Environment;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Tester\CommandTester;

class UpdateCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'sitepackage:update';

    /**
     * Configure the command by defining the name, options and arguments
     */
    protected function configure()
    {
        $this->setDescription('Update the Sitepackage');
    }

    /**
     * Executes the command for showing sys_log entries
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = "https://github.com/teamdigitalde/sitepackage-v10/archive/master.zip";
        $extDir = Environment::getPublicPath().'/typo3conf/ext/';
        $ch = curl_init();

//        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Downloade Zip-Archiv.');

        $f = fopen($extDir.'/master.zip', 'w+');
        $opt = [
            CURLOPT_URL => $url,
            CURLOPT_FILE => $f,
            CURLOPT_FOLLOWLOCATION => true,
            // CURLOPT_RETURNTRANSFER => true,
            CURLOPT_BINARYTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ];
        curl_setopt_array($ch, $opt);
        $file = curl_exec($ch);

        curl_close($ch);
        fclose($f);

        $zip = new \ZipArchive();
        $res = $zip->open($extDir.'/master.zip');
        if ($res === TRUE) {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('File wurde gefunden und wird nun entzippt.');
            $zip->extractTo($extDir); // wohin soll es entpackt werden
            $zip->close();
        } else {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Zip-Archiv wurde nicht gefunden.');
        }

        // Sync sitepackages
        $test = $this->smartCopy($extDir.'sitepackage-v10-master/',$extDir.'sitepackage/');
        if($test == TRUE) {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Hat synchonisiert');
        } else {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Hat nicht synchonisiert');
            return false;
        }

        // Remove Files and Sitepackage
        if(file_exists($extDir.'sitepackage/'.'index.php')) {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Lösche die Datei Sitepackage -> index.php');
            unlink($extDir.'sitepackage/'.'index.php');
        } else {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Die Datei Sitepackage -> index.php konnte nicht gefunden werden.');
        }
        if(file_exists($extDir.'sitepackage/'.'kickstart.sql')) {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Lösche die Datei Sitepackage -> kickstart.sql');
            unlink($extDir.'sitepackage/'.'kickstart.sql');
        } else {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Die Datei Sitepackage -> kickstart.sql konnte nicht gefunden werden.');
        }
        if(file_exists($extDir.'sitepackage/'.'.htaccess')) {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Lösche die Datei Sitepackage -> .htaccess');
            unlink($extDir.'sitepackage/'.'.htaccess');
        } else {
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Die Datei Sitepackage -> .htaccess konnte nicht gefunden werden.');
        }
        if(file_exists($extDir.'sitepackage/'.'.editorconfig')) {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Lösche die Datei Sitepackage -> .editorconfig');
            unlink($extDir.'sitepackage/'.'.editorconfig');
        } else {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Die Datei Sitepackage -> .editorconfig konnte nicht gefunden werden.');
        }
        if(file_exists($extDir.'sitepackage/'.'.gitignore')) {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Lösche die Datei Sitepackage -> .gitignore');
            unlink($extDir.'sitepackage/'.'.gitignore');
        } else {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Die Datei Sitepackage -> .gitignore konnte nicht gefunden werden.');
        }
        if(is_dir($extDir.'sitepackage/Build')) {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Lösche den Ordner Sitepackage -> Build');
            $this->rrmdir($extDir.'sitepackage/Build');
        } else {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Der Ordner Sitepackage -> Build konnte nicht gefunden werden.');
        }
        if(is_dir($extDir.'sitepackage/autoload')) {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Lösche den Ordner Sitepackage -> Autoload');
            $this->rrmdir($extDir.'sitepackage/autoload');
        } else {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Der Ordner Sitepackage -> Autoload konnte nicht gefunden werden.');
        }
        if(is_dir($extDir.'sitepackage/sites')) {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Lösche den Ordner Sitepackage -> Sites');
            $this->rrmdir($extDir.'sitepackage/sites');
        } else {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Der Ordner Sitepackage -> Sites konnte nicht gefunden werden.');
        }
        if(is_dir($extDir.'sitepackage-v10-master')) {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Lösche den Ordner Sitepackage -> Sitepackage-Master');
            $this->rrmdir($extDir.'sitepackage-v10-master');
        } else {
//            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Der Ordner Sitepackage-Master konnte nicht gefunden werden.');
        }
        if(file_exists($extDir.'master.zip')) {
            unlink($extDir.'master.zip');
        }
//        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Das Sitepackage wurde erfolgreich aktualisiert.');
        $io = new SymfonyStyle($input, $output);
        $io->title($this->getDescription());
        $io->write('Write something');
        return 0;
    }

    function rrmdir($src) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                $full = $src . '/' . $file;
                if ( is_dir($full) ) {
                    $this->rrmdir($full);
                }
                else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($src);
    }

    public function smartCopy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755))
    {
        //$result = false;
        if (is_file($source)) {

            if ($dest[strlen($dest)-1]=='/') {
                if (!file_exists($dest)) {
                    cmfcDirectory::makeAll($dest,$options['folderPermission'],true);
                }
                $__dest=$dest."/".basename($source);
            } else {
                $__dest=$dest;
            }
            $result = copy($source, $__dest);
            chmod($__dest,$options['filePermission']);

        } elseif(is_dir($source)) {
            if ($dest[strlen($dest)-1]=='/') {
                if ($source[strlen($source)-1]=='/') {
                    //Copy only contents
                } else {
                    //Change parent itself and its contents
                    $dest=$dest.basename($source);
                    @mkdir($dest);
                    chmod($dest,$options['filePermission']);
                }
            } else {
                if ($source[strlen($source)-1]=='/') {
                    //Copy parent directory with new name and all its content
                    @mkdir($dest,$options['folderPermission']);
                    chmod($dest,$options['filePermission']);
                } else {
                    //Copy parent directory with new name and all its content
                    @mkdir($dest,$options['folderPermission']);
                    chmod($dest,$options['filePermission']);
                }
            }

            $dirHandle=opendir($source);
            while($file=readdir($dirHandle))
            {
                if($file!="." && $file!="..")
                {
                    if(!is_dir($source."/".$file)) {
                        $__dest=$dest."/".$file;
                    } else {
                        $__dest=$dest."/".$file;
                    }
                    $result=$this->smartCopy($source."/".$file, $__dest, $options);
                }
            }
            closedir($dirHandle);

        } else {
            $result=false;
        }

        return $result;
    }
}
