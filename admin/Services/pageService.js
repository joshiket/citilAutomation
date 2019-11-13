app.service("pageService", function(){
	
	this.Paging = {};
	this.Paging.required = true;
	this.Paging.noOfPages = 0;
	this.Paging.currPage = 0;
	this.Paging.noOfRecords = 0;
	this.Paging.pageStart = 0;
	this.Paging.pageEnd = 0;	
	this.Paging.pageCount = 15;
	this.Paging.showNext = false;
	this.Paging.showPrev = false;    
	this.Paging.firstPage = 0;
	this.Paging.lastPage = 0;
    
	this.init = function(obj, pc,required)
	{
		this.Paging.required = required;
		this.Paging.pageCount = pc;
		this.Paging.noOfRecords = obj.data.length;
		this.Paging.noOfPages = parseInt(this.Paging.noOfRecords / this.Paging.pageCount) + 1;
		this.Paging.noOfPages =  (this.Paging.noOfPages==0) ? 1 : this.Paging.noOfPages;		
		this.Paging.currPage = 0;
		this.Paging.firstPage = 0;
		this.Paging.lastPage = this.Paging.noOfPages-1;
		//console.log(this.Paging.lastPage);
		this.Paging.pageStart = this.Paging.currPage * this.Paging.pageCount
		this.Paging.pageEnd = this.Paging.pageStart + this.Paging.pageCount -1;
		if(this.Paging.noOfPages == 1)
			this.Paging.showNext = false;
		else
			this.Paging.showNext = true;
		this.Paging.showPrev = false;
		this.populatePage(obj);

	};
	
	this.First = function(obj)
	{
		this.Paging.currPage = this.Paging.firstPage;
		this.Paging.pageStart = this.Paging.currPage * this.Paging.pageCount;
		this.Paging.pageEnd = this.Paging.pageStart + this.Paging.pageCount -1;
		this.Paging.showPrev = false;
		this.populatePage(obj);
	};
	
	this.Last = function(obj)
	{
		this.Paging.currPage = this.Paging.lastPage;
		this.Paging.pageStart = this.Paging.currPage * this.Paging.pageCount;
		this.Paging.pageEnd = this.Paging.pageStart + this.Paging.pageCount -1;
		this.Paging.showNext = false;
		this.populatePage(obj);
	};
    
	this.Next = function(obj)
	{	
		this.Paging.currPage = (this.Paging.currPage + 1) % this.Paging.noOfPages;
		this.Paging.pageStart = this.Paging.currPage * this.Paging.pageCount;
		this.Paging.pageEnd = this.Paging.pageStart + this.Paging.pageCount -1;
		this.populatePage(obj);
		if(this.Paging.currPage > 0)
			this.Paging.showPrev = true;
		
		if((this.Paging.currPage+1) == this.Paging.noOfPages)
			this.Paging.showNext = false;
    };    
    
	this.Previous = function(obj)	
	{						
		if(this.Paging.currPage == 0 )
		{
			this.Paging.showPrev = false;
			return;
		}
		this.Paging.currPage = (this.Paging.currPage - 1) % this.Paging.noOfPages;
		if(this.Paging.currPage == 0 )
		{
			this.Paging.showPrev = false;
			
		}		
		this.Paging.pageStart = this.Paging.currPage * this.Paging.pageCount;
		this.Paging.pageEnd = this.Paging.pageStart + this.Paging.pageCount -1;		
		this.populatePage(obj);
    };	   
    
	this.populatePage = function(obj)
	{
		var k =0;						
		//console.log(this.Paging.currPage);
		//console.log(obj);
			for(var i = this.Paging.pageStart; i<= this.Paging.pageEnd; i++)
			{			
				obj.data2show[k] = obj.data[i];
				k++;
			}
		
	};

	this.getCurrentPage1 = function()
	{
		return this.Paging.currPage;
	};

	this.showNext = function()
	{
		var result = (this.getNoOfPages() != this.getCurrentPage()) ? true : false;
		return result;
	};

	this.showPrevious = function()
	{
		if(this.Paging.currPage == 0)
			return false;
		else
			return true;
	};	

	this.getCurrentPage = function()
	{
		return this.Paging.currPage + 1;
	};

	this.getNoOfPages = function()
	{
		return this.Paging.noOfPages;
	};

	this.pagingRequired = function()
	{
		return this.Paging.required;
	};

});