<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Recette;
use Symfony\Component\Validator\Validation;


class RecetteUtilTest extends TestCase
{

    /**
     * @dataProvider getRecetteTestCases
     */
    public function testUtilRecettestring($nom, $energy, $fibers, $fruit_pourcentage, $proteins, $satured_fats, $sodium,$sugar,$expected,$null):void
    {
        if ($null==true){
            $this->expectError();
        }   
   
        $recette = Recette::recetteBuild($nom, $energy, $fibers, $fruit_pourcentage, $proteins, $satured_fats, $sodium,$sugar);
        $validator = Validation::createValidatorBuilder()
        ->addDefaultDoctrineAnnotationReader()
        ->getValidator();
        $result = $validator->validate($recette);
        $this->assertEquals($expected,(count($result)==0));
    }

    public function getRecetteTestCases()
    {
        return ['succed when data is correct'=>['recette',1,1,1,1,1,1,1,true,false],

        'succed when nom is empty'=>['',1,1,1,1,1,1,1,true,false],

        'Fails when nom is null'=>[null,1,1,1,1,1,1,1,false,true],
        'Fails when energy is null'=>['recette',null,1,1,1,1,1,1,false,true],
        'Fails when fibers is null'=>['recette',1,null,1,1,1,1,1,false,true],
        'Fails when fruit_pourcentage is null'=>['recette',1,1,null,1,1,1,1,false,true],
        'Fails when proteins is null'=>['recette',1,1,1,null,1,1,1,false,true],
        'Fails when satured_fats is null'=>['recette',1,1,1,1,null,1,1,false,true],
        'Fails when sodium is null'=>['recette',1,1,1,1,1,null,1,false,true],
        'Fails when sugar is null'=>['recette',1,1,1,1,1,1,null,false,true],

        'succed when energy is negatif'=>['recette',-1,1,1,1,1,1,1,true,false],
        'succed when fibers is negatif'=>['recette',1,-1,1,1,1,1,1,true,false],
        'succed when fruit_pourcentage is negatif'=>['recette',1,1,-1,1,1,1,1,true,false],
        'succed when proteins is negatif'=>['recette',1,1,1,-1,1,1,1,true,false],
        'succed when satured_fats is negatif'=>['recette',1,1,1,1,-1,1,1,true,false],
        'succed when sodium is negatif'=>['recette',1,1,1,1,1,-1,1,true,false],
        'succed when sugar is negatif'=>['recette',1,1,1,1,1,1,-1,true,false],

    ];
}

public function testUtilSetEnergyNeg():void
{
    $recette = new recette();

    $recette->setEnergy(-1);
    $this->assertTrue($recette->getEnergy()==0,'succed when energy is negatif');
}
public function testUtilSetFibersNeg():void
{
    $recette = new recette();

    $recette->setFibers(-1);
    $this->assertTrue($recette->getFibers()==0,'succed when fibers is negatif');
}
public function testUtilSetFruitPourcentageNeg():void
{
    $recette = new recette();

    $recette->setFruitPourcentage(-1);
    $this->assertTrue($recette->getFruitPourcentage()==0,'succed when fruit_pourcentage is negatif');
}
public function testUtilSetProteinsNeg():void
{
    $recette = new recette();

    $recette->setProteins(-1);
    $this->assertTrue($recette->getProteins()==0,'succed when proteins is negatif');

}
public function testUtilSetSaturedFatsNeg():void
{
    $recette = new recette();

    $recette->setSaturedFats(-1);
    $this->assertTrue($recette->getSaturedFats()==0,'succed when satured_fats is negatif');

}
public function testUtilSetSodiumNeg():void
{
    $recette = new recette();

    $recette->setSugar(-1);
    $this->assertTrue($recette->getSugar()==0,'succed when sugar is negatif');
}
}
