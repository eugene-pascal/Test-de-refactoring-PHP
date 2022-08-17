<?php

/**
 * Classe pour gérer la table BoTexte
 *
 *
 * @author Elvis (22.10.2007)
 *
 *
 */

class BoTexte {

    public $ProjeC;
    public $ProjeDesc;
    public $BoTexC;
    public $BoTexDesc;
    public $BoConC;
    public $BoConDesc;
    public $LanCode;
    public $TexteId;
    public $TexteDesc;
    public $TexteDescs;
    public $ModF;
    public $Ordre;
    public $Remarque;
    public $DateDebVal;
    public $DateFinVal;
    public $TexteAbr;
    public $TexteAbrs;
    public $UserCreat;
    public $DateCreat;
    public $UserMaj;
    public $DateMaj;

    /**
     * Constructeur de la classe BoTexte
     *
     * @access public
     * @static false
     * @author etrollie (22.10.2007)
     * @return void
     */
    public function __construct($data = null) {
        if (isset($data['ProjeC'])) 		$this->ProjeC = trim($data['ProjeC']);
        if (isset($data['ProjeDesc'])) 		$this->ProjeDesc = trim($data['ProjeDesc']);
        if (isset($data['BoTexC'])) 		$this->BoTexC = trim($data['BoTexC']);
        if (isset($data['BoTexDesc'])) 		$this->BoTexDesc = trim($data['BoTexDesc']);
        if (isset($data['BoConC'])) 		$this->BoConC = trim($data['BoConC']);
        if (isset($data['BoConDesc'])) 		$this->BoConDesc = trim($data['BoConDesc']);
        if (isset($data['ModF'])) 			$this->ModF = trim($data['ModF']);
        if (isset($data['LanCode'])) 		$this->LanCode = trim($data['LanCode']);
        if (isset($data['TexteId'])) 		$this->TexteId = trim($data['TexteId']);
        if (isset($data['TexteDesc'])) 		$this->TexteDesc = $data['TexteDesc'];
        if (isset($data['TexteDescs'])) 	$this->TexteDescs = $data['TexteDescs'];
        if (isset($data['Ordre'])) 			$this->Ordre = trim($data['Ordre']);
        if (isset($data['Remarque'])) 		$this->Remarque = trim($data['Remarque']);
        if (isset($data['DateDebVal'])) 	$this->DateDebVal = trim($data['DateDebVal']);
        if (isset($data['DateFinVal'])) 	$this->DateFinVal = trim($data['DateFinVal']);
        if (isset($data['TexteAbr'])) 		$this->TexteAbr = trim($data['TexteAbr']);
        if (isset($data['TexteAbrs'])) 		$this->TexteAbrs = $data['TexteAbrs'];
        if (isset($data['UserCreat'])) 		$this->UserCreat = trim($data['UserCreat']);
        if (isset($data['DateCreat'])) 		$this->DateCreat = trim($data['DateCreat']);
        if (isset($data['UserMaj'])) 		$this->UserMaj = trim($data['UserMaj']);
        if (isset($data['DateMaj'])) 		$this->DateMaj = trim($data['DateMaj']);
    }


    public static function getTexte($texteId, $lanCode = 37) {

        // *** SIMULATED SQL QUERY ***
        $texts = [
            511 => "<h1>Unisciences en bref</h1>
                    <h2>Unisciences, qu'est-ce que c'est ?</h2><p>Unisciences est une base de données internet consultable 24 heures sur 24.<br> Vitrine de l'Université de Lausanne, fenêtre ouverte sur le monde, elle présente l'ensemble des unités de recherche, ainsi que les noms de tous les collaborateurs et collaboratrices scientifiques.</p>
                    <h2>Des équipes ...</h2>
                    <p>L'Université de Lausanne compte plus de 140 unités de recherche, regroupées au sein de sept Facultés. Les équipes qui les composent travaillent dans des domaines aussi divers que la numismatique grecque, le cybermarketing ou la biologie du développement. Tous ces instituts, centres spécialisés, services hospitaliers, départements et groupes de recherche sont répertoriés dans la base de données Unisciences.</p>
                    <h2>... des femmes et des hommes</h2>
                    <p>Au sein de ces instituts, laboratoires et bibliothèques, 2000 personnes, dont 500 professeur-e-s, travaillent jours après jours sur des projets de recherche de portée nationale ou internationale.<br> L'UNIL est une université humaine, riche surtout des individualités qui la composent. C'est ce potentiel extraordinaire qu'Unisciences vous présente.</p>
                    "
        ];
        if(key_exists($texteId, $texts)){
            $text = $texts[$texteId];
        }else{
            $text = $texteId;
        }
        return $text;
        // *** SIMULATED SQL QUERY ***
    }
}
