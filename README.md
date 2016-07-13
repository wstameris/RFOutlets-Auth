Control devices from anywhere using a Raspberry Pi, [radio frequency-controlled outlets](https://www.amazon.com/Etekcity-Wireless-Electrical-Household-Appliances/dp/B00DQELHBS), and a [433MHz receiver/transmitter](https://www.amazon.com/SMAKN®-433Mhz-Transmitter-Receiver-Arduino/dp/B00M2CUALS) 

Original credit to [Tim Leland](https://timleland.com/wireless-power-outlets/) 
Excellent setup guide by [Sam Kear](https://www.samkear.com/hardware/control-power-outlets-wirelessly-raspberry-pi)  

Additions
- Web UI refresh
- Simple authentication via token strings (SSL is a must!)
- Supports IFTTT triggers
- Supports Amazon Alexa control (via IFTTT)
- Supports Apple Siri control (HomeKit) via [homebridge](https://github.com/nfarina/homebridge)
- Saves outlet state information across devices/platforms
- iOS web clip optimization
