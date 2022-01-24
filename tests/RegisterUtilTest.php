<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Register;
use Symfony\Component\Validator\Validation;


class RegisterUtilTest extends TestCase
{
    /**
     * @dataProvider getRegisterTestCases
     * @param [string] $email
     * @param [array] $roles
     * @param [string] $password
     * @param [string] $nom
     * @param [string] $prenom
     * @param [\DateTimeInterface] $date 
     */
    public function testUtilRegister(string $email,array $roles,string $password,string $nom,string $prenom,\DateTimeInterface $date,bool $expected,bool $null):void
    {
        if ($null==true){
            $this->expectError(); 
        }   
        
        $regiter = Register::registerBuild($email, $roles, $password, $nom, $prenom, $date);
        $validator = Validation::createValidatorBuilder()
        ->addDefaultDoctrineAnnotationReader()
        ->getValidator();
        $result = $validator->validate($regiter);
        $this->assertEquals($expected,(count($result)==0));
    }
    public function getRegisterTestCases()
    {
        return ['succed when data is correct'=>["john@john.net",["ROLE_ADMIN"],"password","wick","john",new \datetime(),true,false],

         'succed when mail is empty'=>["",["ROLE_ADMIN"],"password","wick","john",new \datetime(),true,false],
         'succed when role is empty'=>["john@john.net",[""],"password","wick","john",new \datetime(),true,false],
         'succed when password is empty'=>["john@john.net",["ROLE_ADMIN"],"","wick","john",new \datetime(),true,false],
         'succed when nom is empty'=>["john@john.net",["ROLE_ADMIN"],"password","","john",new \datetime(),true,false],
         'succed when prenom is empty'=>["john@john.net",["ROLE_ADMIN"],"password","wick","",new \datetime(),true,false],];

    }
    public function testUtilRegisterDateNull():void
    {
        
        $this->expectError(); 
                
        $regiter = Register::registerBuild("john@john.net", ["ROLE_ADMIN"], "password", "wick", "john", "");
   
    }
}
