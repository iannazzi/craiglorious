/**
 * Created by embrasse-moi on 1/20/17.
 */
function  PlaySoundV3(filename)
{
    document.getElementById("sound_file").innerHTML='<audio autoplay="autoplay"><source src="' + filename + '.mp3" type="audio/mpeg" /><source src="' + filename + '.ogg" type="audio/ogg" /><embed hidden="true" autostart="true" loop="false" src="' + filename +'.mp3" /></audio>';
}
function PlaySoundV2(soundID)
{
    //<embed src="success.wav" autostart="false" width="0" height="0" id="beep" enablejavascript="true">

    var sound = document.getElementById(soundID);


    try
    {
        sound.Play();
        console.log('sound.Play() success');
        return;
    }
    catch(err)
    {
        console.log('sound.Play() error');
    }
    try
    {
        sound.play();
        console.log('sound.play() success');
        return;
    }
    catch(err)
    {
        console.log('sound.play() error');
    }

}
function PlaySound(soundID)
{
    //<embed src="success.wav" autostart="false" width="0" height="0" id="beep" enablejavascript="true">

    var sound = document.getElementById(soundID);

    //curently this is breaking the android browsers....so fuck em...

    if (browser == 'Google Chrome')
    {
        sound.play();
    }
    else if (browser == 'Android Mobile')
    {
    }
    else
    {
        try
        {
            sound.Play();
        }
        catch(err)
        {
            console.log('attempting to play sound....failed');
        }
    }
}