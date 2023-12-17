/*
Author: Latish Sherigar
Email: latishsherigar@yahoo.co.in
*/
struct{
	char fname[15];
	short int files;
      }d;

void accept_filename(char *filename);
void accept_outputdir(char *outputdir);
char print_formatted_filelength(double filesize);
int show_split_formatmenu(char formatchar);
int accept_split_format_choice(char formatchar);
int accept_lastpartsize(double filesize,double splitsize,double *lastpartsize,int *totalparts);
int splitfiles(char *sourcefilename,int totalparts,double splitsize,double lastpartsize);
void writemetabytes(FILE * fp);
void readbytes(FILE * fp);
void read_metadata(char *sourcefile);
void formatfilename(char * filename);
void start_real_merge_operation(char * sourcefile);
void readsource_writetarget(FILE *fs,FILE *ft);
double accept_splitfilesize(int choice,double filesize);
long getfilesize(char *filename);
void incfileno(int xyz,char *source,char* target);
void merge_incfileno(int xyz,char *filename);


/*-------------------accept_filename function------------*/

void accept_filename(char *filename)
 {
   char ch;
   FILE *fs;
  
 while(1)
  {
   printf("\nFile name(or path) :");
   fflush(stdin);
   scanf("%s",filename);
   fs=fopen(filename,"rb");                /*open file in read mode*/
   if (fs==NULL)
    {
     printf("\n\nFile %s missing.n\n\n\n",filename);
     printf("\nDo you want to try again(y/n):");
     fflush(stdin);
     scanf("%c",&ch);
    
     if((ch!='y')||(ch!='Y'))
       {
        strcpy(filename,"");
        break;
       }
     }
    else{
         break;
         }
   }
 }

/*--------------------accept_outputdir funhction-----------------*/

void accept_outputdir(char *outputdir)
 {
  char ch;
  char tempfilename[100];
  FILE *fs;
  
  while(1)
  {
   printf("\nOutput directory (Press 'ENTER' if in the same directory):");
   fflush(stdin);
   scanf("%s",outputdir); 
   strcpy(tempfilename,outputdir);
   strcat(tempfilename,"temp.temp");
   fs=fopen(tempfilename,"wb");                /*open test file in write mode*/
   if (fs==NULL)
    {
     printf("\n\nCannot write in the specified directory\n\n\n");
     printf("\nDo you want to try again(y/n):");
     fflush(stdin);
     scanf("%c",ch);
    
     if((ch!='y')||(ch!='Y'))
       {
        strcpy(outputdir,"");
        break;
       }
     }
    else{
         break;
        }
   }
 }


/*--------------------formatfilelength--------------------*/

char print_formatted_filelength(double filesize)
{
 char formatchar;
 double a;
 if(filesize <= 1000)
  {
   a=filesize;
  formatchar=' ';
  }

 if(filesize > 1000 && filesize < 1000000)
   {
   a=filesize*0.001;
  formatchar='K';
   }

 if(filesize >= 1000000 && filesize < 1000000000)
  {
   a=filesize * 0.000001;
  formatchar='M';
  }

 if(filesize >= 1000000000)
  {
   a=filesize * 0.000000001;
  formatchar='G';
  }

   printf("\nFile length :%5.0f %cb",a,formatchar);
  
   return(formatchar);
}


/*------------------show_split_formatmenu function---------------*/
int show_split_formatmenu(char formatchar)
{
 int temp=1;

 if(formatchar != ' ')
   {
     printf("\n\nEnter the format in which you want your files to be broken:\n");

     if((formatchar=='M') || (formatchar=='G'))
       {
        printf("\n%d 1.44Mb Floppy Disk .",temp);
        ++temp;
        printf("\n%d Megabytes .",temp);
        ++temp;
       }

     if((formatchar=='K')||(formatchar=='M'))
       {
        printf("\n%d Kilobytes .",temp);
        ++temp;
        printf("\n%d Bytes .",temp);
       }
   }
 else{
     printf("\n\nEnter the size in bytes:\n");
     }

   }
   

/*--------------------accept_split_format_choice-------------------*/
int accept_split_format_choice(char formatchar)
{
 int choice=0,temp;
char ch;

  while(1)
   {
     printf("\n\nEnter your choice:");
     fflush(stdin);
     scanf("%d",&temp);
     
     switch(formatchar)
       {
        case 'G':
        case 'M':choice=temp;
		 break; 
        case 'K': if(temp == 1)
                    {
                     choice=3; 
                    }
                  else{
                     choice=4; 
                   }
                   break;
       }

       if(choice < 1 || choice >4)
         {
           printf("\n\nInvalid choice........");
           printf("\nDo you want to try again(y/n):");
           fflush(stdin);
           ch=getchar();
           if(ch!='y'||ch!='Y')
              return(0);              
	   else
              return(-1);
	 }
       else{
	    return(choice);
	   }		    
   }
 }


/*--------------------accept split file size----------------------*/
double accept_splitfilesize(int choice,double filesize)
{ 
  char strtemp[15];
  char ch;
  double splitsize;
  int entsize;
  long convmultiple;

   switch(choice)
    {
     case 1: splitsize=1380000;
             convmultiple=1;
             break;

     case 2:strcpy(strtemp,"Megabytes");
            convmultiple=1000000;
	    break;

     case 3:strcpy(strtemp,"Kilobytes");
	    convmultiple=1000;
	    break;

     default:strcpy(strtemp,"bytes");
	   convmultiple=1;
	   break;
    }

    if(choice==1)
     {
       return(splitsize);
     }

      printf("\nEach part size(in %s): " ,strtemp);
      fflush(stdin);
      scanf("%d",&entsize);
      splitsize = convmultiple * entsize;

       if(splitsize > filesize)
         {
           printf("\n\nInvalid partsize.\nPart size greater than total file size.");
           printf("\n\nDo you want to try again(y/n):");
           fflush(stdin);
           scanf("%c",&ch);
           if(ch=='y'||ch=='Y')
            {
             return(0);
            }
           else{
              return(-1);
             }
         }
       else{
         fflush(stdin);/*wrote this code because of a bug*/
         scanf("%c",&ch);/*''*/
         printf("\nWant to change the number of parts(y/n):");
         fflush(stdin);
         scanf("%c",&ch);

         if(ch=='y'||ch=='Y')
           {
             return(0);
           }
          else{  
               return(splitsize);
              }
        }
   
 }
 


/*-----------------------accept_lastpartsize function---------------------------*/
int accept_lastpartsize(double filesize,double splitsize,double *lastpartsize,int *totalparts)
{
 char ch;
 *totalparts=(filesize/splitsize)+1;
 *lastpartsize=filesize -(splitsize * (*totalparts-1));
 
 if(*(totalparts) > 999)
  {
   printf("\n\n\n\nToo many parts to create.Please reduce the number of parts.");
   fflush(stdin);
   printf("\n\n\n\nDo you want to try again(y/n):.");
   ch=getchar();
   if(ch=='y'||ch=='Y')
     {
      return(0);
      }
   else{
         return(-1);
        }
  }
  else{
        return(1);
      }
}


/*---------------------splitfiles-------------------------------*/
int splitfiles(char *sourcefilename,int totalparts,double splitsize,double lastpartsize)
{
 FILE *fs,*ft;
 int progress,i,j,z,chunks;
 char buff[1025],targetfilename[100],temp[20];
 double chunksize,buffsize,lastbuffsize;
 
 printf("\n\nBreaking files.....\n");

 fs=fopen(sourcefilename,"rb");
         
 if(fs==NULL)
  {
    printf("\n\nFile %s missing.",sourcefilename);
    exit(1);
  }

 strcpy(temp,"Percent Completed :");
 printf("\n");

 for(i=0;i<totalparts;++i)
 {
   progress=(100*(i+1))/totalparts;
   printf("%s%d",temp,progress);
   
   for(j=0;j<(strlen(temp))+2;++j)
    {
     printf("\b");
    }

   if(progress==100)
    {
      printf("\b");
      printf("File splitting finished.\n");
    }
   chunksize=splitsize;

   if(i==(totalparts-1))
    {
    chunksize=lastpartsize;
    }

   incfileno(i,sourcefilename,targetfilename);
   ft=fopen(targetfilename,"wb");
         
   if(ft==NULL)
    {
     printf("\n\nFile %s missing.",targetfilename);
     exit(1);
    }
    
   if(i==0)
     {
      strcpy(d.fname,sourcefilename);
      d.files=totalparts;
      writemetabytes(ft);
     } 

    buffsize=1024;
    chunks=chunksize/buffsize;
    lastbuffsize=chunksize-(buffsize*chunks);

    if(lastbuffsize!=0)
      {
        ++chunks;
      }
   
   for(z=0;z<chunks;++z)
       {
	if(z==chunks-1)
 	  {
	    buffsize=lastbuffsize; 	    	    	    
	  }
	if(buffsize > 0)
 	  {
	     fread(buff,buffsize,1,fs);
	     fwrite(buff,buffsize,1,ft);
	  }		 
        }
    fclose(ft);
  }
fclose(fs);
}


/*-----------------------------------------------------------------*/
void writemetabytes(FILE * fp)
{
  if(sizeof(d)>sizeof(d.fname)+sizeof(d.files))
        {
	    fwrite(&d.fname,sizeof(d.fname),1,fp);
 	    fwrite(&d.files,sizeof(d.files),1,fp);
	}
      else{
	      fwrite(&d,sizeof(d),1,fp); 
	  }
}

/*----------------------------------------------------------*/
void readbytes(FILE * fp)
{
  if(sizeof(d)>sizeof(d.fname)+sizeof(d.files))
        {
	    fread(&d.fname,sizeof(d.fname),1,fp);
 	    fread(&d.files,sizeof(d.files),1,fp);
        }
      else{
	      fread(&d,sizeof(d),1,fp); 
	  }
}

/*-------------------read metadata-------------------------*/
void read_metadata(char *sourcefile)
{
 FILE *fs;

 sourcefile[0]='0';
 sourcefile[1]='0';
 sourcefile[2]='0';

 fs=fopen(sourcefile,"rb");
 if(fs==NULL)
  {
   printf("\n\n\nFile %s missing. ",sourcefile);
   printf("\n\nFile name may be invalid.");
  }

 readbytes(fs);
 fclose(fs);
 
}

/*------------------------------------------------------------------*/
void formatfilename(char * filename)
{
 filename[0]='0';
 filename[1]='0';
 filename[2]='0';
}

/*---------------------start_real_merge_operation----------------------*/
void start_real_merge_operation(char * sourcefile)
{
  FILE *ft,*fs;
  char temp[150];
  int i=0,j=0,progress;
   
 ft=fopen(d.fname,"wb");

 if(ft==NULL)
 {
  printf("\n\nFile %s cannot be opened.",d.fname) ;
 }

 printf("\nMerging Files.....\n");
 strcpy(temp,"Percent Completed :");
 printf("\n");

 for(i=0;i<d.files;++i)
 {
   progress=(100*(i+1))/d.files;
   printf("%s%d",temp,progress);
   
   for(j=0;j<(strlen(temp))+2;++j)
    {
     printf("\b");
    }

   if(progress==100)
    {
      printf("\b");
      printf("File Merging finished.\n");
    }

   fs=fopen(sourcefile,"rb");

   if(fs==NULL)
    {
     printf("\n\n\nFile %s missing. ",sourcefile);
    }

   if(i==0)
    {
      readbytes(fs);  /*just to increment the file pointer*/
    }

   readsource_writetarget(fs,ft);
  
   fclose(fs);

   merge_incfileno(i+1,sourcefile);
 }
fclose(ft);

}


/*---------------------------------------------------------*/
void readsource_writetarget(FILE *fs,FILE *ft)
{
 
 int buffsize=1024,a;
 int count=0;
 char buff[1024];
 double pointer=0;
 static fileno=1;
 
/*this function reads the bytes in multiples of 1024*/
/*the remaining bytes are read in the multiples of 1*/
/*for the 1stfile the pointer is 17 bytes ahead */

if(fileno==1)	/*for the 1st file the pointer is 17 bytes plus for the metadata*/
 {
  pointer=ftell(fs);
 }

++fileno;

 while(1)
  {
    while(1)
     {
       a=fread(buff,buffsize,1,fs);
    
       if(a==0)
        {
          break;
        }
       fwrite(buff,buffsize,1,ft);
       pointer=pointer+buffsize;
     }

    ++count;

    if(count>1)
     {
       break;
     }

    buffsize=1; 
    fseek(fs,pointer,SEEK_SET);
  }
}

/*-------------------------getfilesize function--------------------*/
long getfilesize(char *filename)
{
char buff[1024];
int buffsize=1024,count=0,a=0;
FILE * fs;
double filesize;

 fs=fopen(filename,"rb");
    
 while(1)
  {
    while(1)
     {
       a=fread(buff,buffsize,1,fs);
    
       if(a==0)
        {
          break;
        }
       filesize=filesize+buffsize;
     }

    ++count;

    if(count>1)
     {
       break;
     }

    buffsize=1; 
    fseek(fs,filesize,SEEK_SET);
  }

    fclose(fs);

    return(filesize);
}

/*=======================incfileno fun======================*/
void incfileno(int xyz,char *source ,char *target)
{ 
  int x,y,z,modx,mody;
 
  x = xyz / 100;
  modx = xyz % 100;
  y = modx / 10;
  mody = modx % 10;
  z=mody;
  x+=48;
  y+=48;
  z+=48;

  target[0]=x;
  target[1]=y;
  target[2]=z;
  target[3]='\0';             /*to make 'target' a seperate string before concentination*/
  strcat(target,source);
  
}


/*--------------------inctargetfileno-------------------------*/
void merge_incfileno(int xyz,char *filename)
{
  int x,y,z,modx,mody;
 
  x = xyz / 100;
  modx = xyz % 100;
  y = modx / 10;
  mody = modx % 10;
  z=mody;
  x+=48;
  y+=48;
  z+=48;

  filename[0]=x;
  filename[1]=y;
  filename[2]=z;
  
}

