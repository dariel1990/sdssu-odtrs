<?php
class Upload {
    
    var $FileName;
    var $TempFileName;
    var $UploadDirectory;
    var $ValidExtensions;
    var $Message;
    var $MaximumFileSize;
    var $IsImage;
    var $MaximumWidth;
    var $MaximumHeight;

    function Upload()
    {

    }

    function ValidateSize()
    {
        $MaximumFileSize = $this->MaximumFileSize;
        $TempFileName = $this->GetTempName();
        $TempFileSize = filesize($TempFileName);

        if($MaximumFileSize == "") {
            $this->SetMessage("WARNING: There is no size restriction.");
            return true;
        }

        if ($MaximumFileSize <= $TempFileSize) {
            $this->SetMessage("ERROR: The file is too big. It must be less than $MaximumFileSize and it is $TempFileSize.");
            return false;
        }

        $this->SetMessage("Message: The file size is less than the MaximumFileSize.");
        return true;
    }

    function ValidateDirectory()
    {
        $UploadDirectory = $this->UploadDirectory;

        if (!$UploadDirectory) {
            $this->SetMessage("ERROR: The directory variable is empty.");
            return false;
        }

        if (!is_dir($UploadDirectory)) {
            $this->SetMessage("ERROR: The directory '$UploadDirectory' does not exist.");
            return false;
        }

        if (!is_writable($UploadDirectory)) {
            $this->SetMessage("ERROR: The directory '$UploadDirectory' does not writable.");
            return false;
        }

        if (substr($UploadDirectory, -1) != "/") {
            $this->SetMessage("ERROR: The traling slash does not exist.");
            $NewDirectory = $UploadDirectory . "/";
            $this->SetUploadDirectory($NewDirectory);
            $this->ValidateDirectory();
        } else {
            $this->SetMessage("MESSAGE: The traling slash exist.");
            return true;
        }
    }

    function ValidateImage() {
        $MaximumWidth = $this->MaximumWidth;
        $MaximumHeight = $this->MaximumHeight;
        $TempFileName = $this->TempFileName;

	if($Size = @getimagesize($TempFileName)) {
		$Width = $Size[0];   //$Width is the width in pixels of the image uploaded to the server.
		$Height = $Size[1];  //$Height is the height in pixels of the image uploaded to the server.
	}

        if ($Width > $MaximumWidth) {
            $this->SetMessage("The width of the image [$Width] exceeds the maximum amount [$MaximumWidth].");
            return false;
        }

        if ($Height > $MaximumHeight) {
            $this->SetMessage("The height of the image [$Height] exceeds the maximum amount [$MaximumHeight].");
            return false;
        }

        $this->SetMessage("The image height [$Height] and width [$Width] are within their limitations.");     
        return true;
    }
	
    function UploadFile()
    {

 		if (!$this->ValidateSize()) {
            die($this->GetMessage());
        }

        else if (!$this->ValidateDirectory()) {
            die($this->GetMessage());
        }

        else if ($this->IsImage && !$this->ValidateImage()) {
            die($this->GetMessage());
        }

        else {

            $FileName = explode(".", $this->FileName);
			$NewFileName = round(microtime(true)) . '.' . end($FileName);
            $TempFileName = $this->TempFileName;
            $UploadDirectory = $this->UploadDirectory;

            if (is_uploaded_file($TempFileName)) { 
                move_uploaded_file($TempFileName, $UploadDirectory . $NewFileName);
                return true;
            } else {
                return false;
            }

        }

    }

    #Accessors and Mutators beyond this point.
    #Siginificant documentation is not needed.
    function SetFileName($image)
    {
        $this->FileName = $image;
	}
	
    function SetUploadDirectory($image)
    {
        $this->UploadDirectory = $image;
    }

    function SetTempName($image)
    {
        $this->TempFileName = $image;
    }

    function SetValidExtensions($image)
    {
        $this->ValidExtensions = $image;
    }

    function SetMessage($image)
    {
        $this->Message = $image;
    }

    function SetMaximumFileSize($image)
    {
        $this->MaximumFileSize = $image;
    }
   
    function SetIsImage($image)
    {
        $this->IsImage = $image;
    }

    function SetMaximumWidth($image)
    {
        $this->MaximumWidth = $image;
    }

    function SetMaximumHeight($image)
    {
        $this->MaximumHeight = $image;
    }   
    function GetFileName()
    {
		$FileName = explode(".", $this->FileName);
		$NewFileName = round(microtime(true)) . '.' . end($FileName);
        return $NewFileName;
    }

    function GetUploadDirectory()
    {
        return $this->UploadDirectory;
    }

    function GetTempName()
    {
        return $this->TempFileName;
    }

    function GetValidExtensions()
    {
        return $this->ValidExtensions;
    }

    function GetMessage()
    {
        if (!isset($this->Message)) {
            $this->SetMessage("No Message");
        }

        return $this->Message;
    }

    function GetMaximumFileSize()
    {
        return $this->MaximumFileSize;
    }

    function GetEmail()
    {
        return $this->Email;
    }

    function GetIsImage()
    {
        return $this->IsImage;
    }

    function GetMaximumWidth()
    {
        return $this->MaximumWidth;
    }

    function GetMaximumHeight()
    {
        return $this->MaximumHeight;
    }
}


?> 