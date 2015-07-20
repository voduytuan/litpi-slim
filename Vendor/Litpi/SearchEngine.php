<?php
namespace Litpi;

require('sphinxapi.php');

class SearchEngine
{
    public $indexedTables = array(
        'project',
        'story',
        'issue',
        'file',
        'news',
        'cmsproductindex',
        'cmsproductlanguageindex',
        'salerelproductoptiongroupindex',
        'relproductfieldindex'
    );
    public $searchTables = array();
    public $searcher = null;

    public function __construct()
    {
        global $conf;

        $this->searcher = new \SphinxClient();
        $this->searcher->SetServer($conf['sphinx'][0]['ip'], $conf['sphinx'][0]['port']);
        $this->searcher->SetConnectTimeout(1);
        $this->searcher->SetArrayResult(true);
        $this->searcher->SetMatchMode(SPH_MATCH_EXTENDED2);
        $this->searcher->SetRankingMode(SPH_RANK_PROXIMITY_BM25);

    }

    public function addtable($tablename)
    {
        if (in_array($tablename, $this->indexedTables) && !in_array($tablename, $this->searchTables)) {
            $this->searchTables[] = $tablename;

            return true;
        } else {
            return false;
        }
    }

    public function search($keyword)
    {
        $output = array();

        //query tu index
        foreach ($this->searchTables as $tablename) {
            $this->searcher->addQuery($keyword, "$tablename");
        }

        $result = $this->searcher->runQueries();

        //lay gia tri tra ve theo index
        $indexCount = count($result);

        for ($i = 0; $i < $indexCount; $i++) {
            if ($result[$i]['total_found'] > 0) {
                $arrayId = array();

                for ($k = 0; $k < count($result[$i]['matches']); $k++) {
                    $arrayId[] = $result[$i]['matches'][$k];
                }

                $arrayId['result_found'] = $result[$i]['total_found'];
                $output[$this->searchTables[$i]] = $arrayId;
            }
        }

        return $output;
    }
}
