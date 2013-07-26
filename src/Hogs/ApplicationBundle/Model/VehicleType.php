<?php

namespace Hogs\ApplicationBundle\Model;

class VehicleType
{
	static public function id( $value )
	{
		switch ( $value )
		{
			case "lightTank": return 1;
			case "mediumTank": return 2;
			case "heavyTank": return 3;
			case "AT-SPG": return 4;
			case "SPG": return 5;
		}
	}

	static public function value( $id )
	{
		switch ( $id )
		{
			case 1: return "lightTank";
			case 2: return "mediumTank";
			case 3: return "heavyTank";
			case 4: return "AT-SPG";
			case 5: return "SPG";
		}
	}
}
