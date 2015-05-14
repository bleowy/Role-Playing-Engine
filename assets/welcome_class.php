<?php 

class Welcome
{
    private $_weather;
    private $_city;
    
    public function __construct($city,$weather)
    {
        $this -> _weather = $weather;
        $this -> _city = $city;
    }
    
    public function weatherRain()
    {
        $this -> Rain = 'Welcome in '.$this -> _city.' Its seems to rain here, so you took your bag and go along...';
    }
    
    public function weatherSunny()
    {
        $this -> Sunny = 'Welcome in '.$this -> _city.' Its seems to be sunny here, so you took your bag and go along...';
    }
    
    public function checkBeforeGenerate()
    {
        //so here is a method which check a what weather is now and return to generateMessage();
        //if u want to add more weather in your game u should add them here to and the messages...
        
        if(($this -> _weather) == 'Sunny')
        {
            self::weatherSunny();
            $this -> message = $this -> Sunny;
        }
        
        if(($this -> _weather) == 'Rain')
        {
            self::weatherRain();
            $this -> message = $this -> Rain;
        }
        
        if(empty($this -> message))
        {
            $this -> message = 'Somethin wrong.There isnt weather "'.$this -> _weather.'" declared in assets/welcome_class.php';
        }
    }
    
    public function generateMessage()
    {
        self::checkBeforeGenerate();
        echo $this -> message;
    }
        
}
?>