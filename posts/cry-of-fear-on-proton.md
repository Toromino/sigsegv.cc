{"title": "How to play Cry of Fear 1.6a on Proton", "date": "2021-02-12T12:55:27+01:00","category": "technology", "tags": [], "draft": false}
Cry of Fear is a psychological survival horror game taking place in a
deserted town. I have a lot of memories playing Cry of Fear when it was
released as a mod for Half-Life. However, I have not played it much
since it became a standalone game. The standalone version is still based
on Half Life 1's GoldSrc engine from 1998, but it is modified to a point
where I have not been able to play it on GNU/Linux. Team Psyskallar
understandably focused primarily on providing support for Windows.
Native builds of the game were never released for either Linux or MacOS.

My attempts at running Cry of Fear on
[Xash3D](https://github.com/FWGS/xash3d-fwgs), which is an open-sourced
game-engine compatible with GoldSrc, have been unsuccessful as well.
Though things have changed thanks to Proton (which is Valve's fork of
wine; a compatibility layer to play Windows games on Linux).

You will want to use a recent version of Proton, at the time of writing I used
Proton version 5.13-5 - but anything starting from Proton 5.0 should
work fine\!

## Patching the Paranoia renderer

The game ships with a modified renderer called [Paranoia
renderer](https://www.moddb.com/mods/paranoia/downloads/paranoia-toolkit),
which features dynamic lighting amongst other things. This renderer,
however, is the cause of bugs like three hands being visible or a
non-functional flashlight.

There is a workaround available to get dynamic lighting to work, which
the people at [WineHQ](https://forum.winehq.org/viewtopic.php?t=32263)
forums came up with.

1.  Download the patch at
    [cof-opengl32.tar.gz](https://forum.winehq.org/download/file.php?id=1537)
    and move it into your Cry of Fear game folder
2.  Extract the patch and run it
	```
	tar -xvf cof-opengl32.tar.gz
	patch --binary opengl32.dll < cof-opengl32.patch
	```
3.  Rename `opengl32.dll` to `openpr32.dll` (or a different file name;
    must have same amount of characters as `opengl32.dll`)
4.  Change every occurence of 'opengl32.dll' to 'openpr32.dll' in
    `hw.dll` and `cryoffear/cl_dlls/client.dll` using a hex editor. In my case I just used vim and ran the 'find and replace' command on both files:
	
	`%s/opengl32.dll/openpr32.dll/g`

Most lighting issues should be solved now. :)

## Sources

  - <https://forum.winehq.org/viewtopic.php?t=32263>
  - <https://www.protondb.com/app/223710>
