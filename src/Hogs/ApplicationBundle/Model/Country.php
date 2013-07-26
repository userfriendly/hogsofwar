<?php

namespace Hogs\ApplicationBundle\Model;

class Country
{
	static public function id( $value )
	{
		switch ( $value )
		{
			case "ussr": return 0;
			case "germany": return 1;
			case "usa": return 2;
			case "china": return 3;
			case "france": return 4;
			case "uk": return 5;
		}
	}

	static public function value( $id )
	{
		switch ( $id )
		{
			case 0: return "ussr";
			case 1: return "germany";
			case 2: return "usa";
			case 3: return "china";
			case 4: return "france";
			case 5: return "uk";
		}
	}
}
