<?php

namespace Litpi;

/**
* Unoconv class wrapper
*
* @author Rafael Goulart <rafaelgou@gmail.com>
* @see http://tech.rgou.net/
*/
class Unoconv
{

    /**
    * Basic converter method
    *
    * @param string $originFilePath Origin File Path
    * @param string $toFormat       Format to export To
    * @param string $outputDirPath  Output directory path
    */
    public static function convert($originFilePath, $outputDirPath, $toFormat)
    {
        $command = 'unoconv --format %s --output %s %s';
        $command = sprintf($command, $toFormat, $outputDirPath, $originFilePath);

        //echo $command;
        system($command, $output);

        return $output;
    }

    /**
    * Convert to PDF
    *
    * @param string $originFilePath Origin File Path
    * @param string $outputDirPath  Output directory path
    */
    public static function convertToPdf($originFilePath, $outputDirPath)
    {
        return self::convert($originFilePath, $outputDirPath, 'pdf');
    }

    /**
    * Convert to TXT
    *
    * @param string $originFilePath Origin File Path
    * @param string $outputDirPath  Output directory path
    */
    public static function convertToTxt($originFilePath, $outputDirPath)
    {
        return self::convert($originFilePath, $outputDirPath, 'txt');
    }
}
