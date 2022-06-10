
DECLARE @cnt INT = 331000;
WHILE @cnt < 425000
BEGIN 
UPDATE Movie
SET cover_image = CHOOSE( (ROUND( (RAND()*6),0))+1 , 'AP_pic.jpg', 'ET_pic.jpg', 'GH_pic.jpg', 'HA_pic.jpg', 'IJ_pic.jpg', 'PF_pic.jpg', 'TI_pic.jpg') 
WHERE movie_id = @cnt;
SET @cnt = @cnt+1;
END;

/*De code bij choose/random werkte niet helemaal zoals ik hoopte. Bij een aantal films bleef de cover_image leeg. Daarom nogmaals een keertje random langs de lege
velden en daarna maar de overgebleven gaten dichtplakken met de waarde titanic. Als iemand kan terugkoppelen waarom CHOOSE zo niet in 1 keer werkte dan hoor ik het graag. */


DECLARE @count INT = 331000;
WHILE @count < 425000
BEGIN 
UPDATE Movie
SET cover_image = CHOOSE( (ROUND( (RAND()*6),0))+1 , 'AP_pic.jpg', 'ET_pic.jpg', 'GH_pic.jpg', 'HA_pic.jpg', 'IJ_pic.jpg', 'PF_pic.jpg', 'TI_pic.jpg') 
WHERE movie_id = @count AND cover_image is NULL;
SET @count = @count+1;
END;

UPDATE Movie
SET cover_image = 'TI_pic.jpg'
WHERE cover_image is NULL;


UPDATE Movie
SET URL = 'AP_Movie.MP4'
WHERE cover_image = 'AP_pic.jpg';

UPDATE Movie
SET URL = 'ET_Movie.MP4'
WHERE cover_image = 'ET_pic.jpg';

UPDATE Movie
SET URL = 'GH_Movie.MP4'
WHERE cover_image = 'GH_pic.jpg';

UPDATE Movie
SET URL = 'HA_Movie.MP4'
WHERE cover_image = 'HA_pic.jpg';

UPDATE Movie
SET URL = 'IJ_Movie.MP4'
WHERE cover_image = 'IJ_pic.jpg';

UPDATE Movie
SET URL = 'PF_Movie.MP4'
WHERE cover_image = 'PF_pic.jpg';

UPDATE Movie
SET URL = 'TI_Movie.MP4'
WHERE cover_image = 'TI_pic.jpg';


