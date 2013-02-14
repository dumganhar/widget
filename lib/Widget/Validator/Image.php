<?php
/**
 * Widget Framework
 *
 * @copyright   Copyright (c) 2008-2013 Twin Huang
 * @license     http://www.opensource.org/licenses/apache2.0.php Apache License
 */

namespace Widget\Validator;

/**
 * @package     Widget
 * @author      Twin Huang <twinh@yahoo.cn>
 */
class Image extends File
{
    protected $notDetectedMessage = '%name% is not a valid image or the size of the image could not be detected';

    protected $widthTooBigMessage = '%name% width is too big (%width%px), allowed maximum width is %maxWidth%px';
    
    protected $widthTooSmallMessage = '%name% width is too small (%width%px), expected minimum width is %minWidth%px';
    
    protected $heightTooBigMessage = '%name% height is too big (%height%px), allowed maximum height is %maxHeight%px';
    
    protected $heightTooSmallMessage = '%name% height is too small (%height%px), expected minimum height is %minHeight%px';
    
    protected $maxWidth;
    
    protected $minWidth;
    
    protected $maxHeight;
    
    protected $minHeight;
    
    /**
     * The detected width of image
     * 
     * @var int
     */
    protected $width;
    
    /**
     * The detected height of image
     * 
     * @var int
     */
    protected $height;
    
    public function __invoke($file, $options = array())
    {
        parent::__invoke($file, $options);
        if ($this->hasError('notString') || $this->hasError('notFound')) {
            return false;
        }
        
        $size = @getimagesize($file);
        if (false === $size) {
            $this->addError('notDetected');
            return false;
        }
        
        $this->width = $size[0];
        $this->height = $size[1];
        
        if ($this->maxWidth && $this->maxWidth < $this->width) {
            $this->addError('widthTooBig', array(
                'maxWidth' => $this->maxWidth,
                'width' => $this->width
            ));
        }
        
        if ($this->minWidth && $this->minWidth > $this->width) {
            $this->addError('widthTooSmall', array(
                'minWidth' => $this->minWidth,
                'width' => $this->width
            ));
        }
        
        if ($this->maxHeight && $this->maxHeight < $this->height) {
            $this->addError('heightTooBig', array(
                'maxHeight' => $this->maxHeight,
                'height' => $this->height
            ));
        }
        
        if ($this->minHeight && $this->minHeight > $this->height) {
            $this->addError('heightTooSmall', array(
                'minHeight' => $this->minHeight,
                'height' => $this->height
            ));
        }
        
        return !$this->errors;
    }
}
