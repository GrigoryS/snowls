<?

class Template {
	private $templateVars;
	private $templateName;
	private $templatePath;

	
	function __construct(argument)
	{
		$this->templateVars = array();
		$this->templateName = '';
		$this->templatePath = '';
	}
	public function addVar($varName, $varValue) {
		if ($varName!='' or $varValue!='') {
			$this->templateVars[$varName] = $varValue;
			return true;
		}
		return false;
	}
	public function __get($varName){
		if(array_key_exists($VarName, $this->templateVars)) {
			if ($this->templateVars[$varName] instanceof Template) {
            	return $this->templateVars[$varName]->Prepare();
      }
      else{
        return $this->templateVars[$VarName];
      }
    }
    return false;
	}
	public function setName($templateName) {
    $this->templateName = $templateName;
	}
  public function SetPath($templatePath)
  {
    $this->templatePath = $templatePath;
  }
  public function Display()
  {
    if (file_exists($this->templatePath)) {
      include $this->templatePath;
    }
  }
}
$Template = new View;
?>