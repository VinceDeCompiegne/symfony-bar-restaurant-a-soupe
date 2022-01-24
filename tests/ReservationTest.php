<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Component\Validator\Validation;
use InvalidArgumentException;

class ReservationTest extends TestCase
{
        /**
         * @dataProvider getReservationTestCases
        */
        public function testUtilreservation($date,$chck,$email,$expected):void
        {
            
            $reservation = Reservation::reservationBuild($date,$chck,$email);
            $validator = Validation::createValidatorBuilder()
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();
            $result = $validator->validate($reservation);
            $this->assertEquals($expected,(count($result)==0));
        }
        public function getReservationTestCases()
        {
            $mail = new user();
            return ['succed when data is correct'=>[new \datetime(),1,$mail,true]
            ,];
    
        }
        public function testUtilReservationrDateNull():void
        {
            
            $this->expectError(); 
            $mail = new user();       
            $reservation = Reservation::reservationBuild(null,1,$mail);
       
        }
        public function testUtilReservationrChckNull():void
        {
            
            $this->expectError(); 
            $mail = new user();       
            $reservation = Reservation::reservationBuild(new \datetime(),null,$mail);
       
        }
        public function testUtilReservationrMailNull():void
        {
            //$this->expectError();
            //$this->expectException(PHPUnit\Framework\Error\Error::class); 
            //$this->expectException(InvalidArgumentException::class);
            $reservation = Reservation::reservationBuild(new \datetime(),1,Null);
       
        }
}
