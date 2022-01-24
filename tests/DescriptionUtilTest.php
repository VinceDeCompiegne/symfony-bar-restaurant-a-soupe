<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Description;
use App\Entity\Recette;
use Symfony\Component\Validator\Validation;

class DescriptionUtilTest extends TestCase
{

    /**
     * @dataProvider getDescriptionTestCases
     * @param [Recette] $nom     
     * @param [String] $description
     * @param [Float] $prix
     * @param [String] $image
     * @param [Int] $active
     * @param [Int] $aime
     * @return void
     */
    public function testUtilDescription($nom, $description, $prix, $image, $active, $aime,$expected,$null):void
    {
        if ($null==true){
            $this->expectError();
        }   

        $desc= Description::descriptionbuild($nom,$description,$prix,$image,$active,$aime);
        $validator = Validation::createValidatorBuilder()
        ->addDefaultDoctrineAnnotationReader()
        ->getValidator();
        $result = $validator->validate($desc);
        $this->assertEquals($expected,(count($result)==0));
    }

    public function getDescriptionTestCases()
    {
        $nom = new recette();
        return ['succed when data is correct'=>[$nom,'description',1.0,'image',1,1,true,false],
        
        'Fails when recette is null'=>[null,'description',1.0,'image',1,1,false,true],
        //'Fails when description is null'=>[$nom,null,1.0,'image',1,1,false,true],
        'Fails when prix is null'=>[$nom,'description',null,'image',1,1,false,true],
        'Fails when image is null'=>[$nom,'description',1.0,null,1,1,false,true],
        'Fails when active is null'=>[$nom,'description',1.0,'image',null,1,false,true],
        'Fails when aime is null'=>[$nom,'description',1.0,'image',1,null,false,true],

        'Fails when recette is empty'=>['','description',1.0,'image',1,1,false,true],
        'succed when description is empty'=>[$nom,'',1.0,'image',1,1,true,false],
        'Fails when prix is empty'=>[$nom,'description','','image',1,1,false,true],
        'succed when image is empty'=>[$nom,'description',1.0,'',1,1,true,false],
        'Fails when active is empty'=>[$nom,'description',1.0,'image','',1,false,true],
        'Fails when aime is empty'=>[$nom,'description',1.0,'image',1,'',false,true],

        'succed when prix is negatif'=>[$nom,'description',-1.0,'image',1,1,true,false],
        'succed when active is negatif'=>[$nom,'description',1.0,'image',-1,1,true,false],
        'succed when aime is negatif'=>[$nom,'description',1.0,'image',1,-1,true,false],

        'succed when prix is zero'=>[$nom,'description',0,'image',1,1,true,false],
        'succed when active is zero'=>[$nom,'description',1.0,'image',0,1,true,false],
        'succed when aime is zero'=>[$nom,'description',1.0,'image',1,0,true,false],

        'succed when prix is positif'=>[$nom,'description',1.0,'image',1,1,true,false],
        'succed when active is positif'=>[$nom,'description',1.0,'image',1,1,true,false],
        'succed when aime is positif'=>[$nom,'description',1.0,'image',1,1,true,false],
        ];

    }

    // public function testSomething(): void
    // {
    //     $this->assertTrue(true);
    // }

}
