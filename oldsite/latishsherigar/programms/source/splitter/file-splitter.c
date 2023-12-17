/*
Author: Latish Sherigar
Email: latishsherigar@yahoo.co.in
*/
#include<stdio.h>
#include<string.h>
#include"file-splitter.h"



void split();
void merge();
void author();
void help();

/*==========================MAIN fun=================================*/
 int main()
{
int choice;
char ch;

while(1)
{
  printf("\n\t\t\t\tSPLITTER\n\t\t\t\t________\n\n\n\n");
  printf("\n\n\n1.Splitter.");
  printf("\n\n2.Merger.");
  printf("\n\n3.Help.");
  printf("\n\n4.Author.");
  printf("\n\n5.Exit");
  printf("\n\n\n\nEnter your choice: ");
  fflush(stdin);
  scanf("%d",&choice);

  switch(choice)
   {
     case 1:split();
            break;
     case 2:merge();
            break;
     case 3:help();
            break;
     case 4:author();
            break;
     case 5:return(0);
   }

   printf("\n\n\n\nWant to continue(y/n):");
   fflush(stdin);
   scanf("%c",&ch);
   ch=tolower(ch);
   if((ch!='y')||(ch!='Y'))
      return(0);
 }
}




/*====================Split function==============================*/

void  split()
{
 char source_filename[100];
 char outputdir[100];
 char ch,formatchar;
 double filesize,splitsize,lastpartsize;
 int retval,totalparts;

/*accept the source filename*/
accept_filename(source_filename);

/*accept the target output directory*/
accept_outputdir(outputdir);

/*get the file size*/
filesize=getfilesize(source_filename);

/*print the formatted filelength*/
formatchar=print_formatted_filelength(filesize);

 while(1)
 {
  /*show the splitting format menu*/
  show_split_formatmenu(formatchar);

  /*accept the split format*/
  retval=accept_split_format_choice(formatchar);
  
  if(retval==-1)
    {
     exit(0);
    }
  if(retval==0)
    { 
     continue;
    }

  /*accept the split size*/
  retval=accept_splitfilesize(retval,filesize);
  splitsize=retval;

  if(retval==-1)
    {
     exit(0);
    }
   if(retval==0)
    { 
      continue;
    }

  /*accept the last part size*/
  retval=accept_lastpartsize(filesize,splitsize,&lastpartsize,&totalparts);
  
   if(retval==-1)
    {
     exit(0);
    }
   if(retval==0)
    { 
      continue;
    }
   if(retval==1)
     {
      splitfiles(source_filename,totalparts,splitsize,lastpartsize);
      break;        
     }
 }

}


/*====================merge fun==============================*/

void merge()
 {
 char sourcefile[100],outputdir[100];

 /*accept the source filename*/
 accept_filename(sourcefile);
 
 /*format filename*/
 formatfilename(sourcefile);

 /*accept the target output directory*/
 accept_outputdir(outputdir);

 /*read the meta data into the structure*/
 read_metadata(sourcefile);
 
 /*start the real process*/
 start_real_merge_operation(sourcefile);
}


 /*====================Author fun===================*/
void  author()
{
char ch;
printf("\n\n\n\t\t\t\tSPLITTER\n\t\t\t\t--------");
printf("\n\n\n\tProgram author: Latish Sherigar");
printf("\n\n\tEmail id: latishsherigar@yahoo.co.in");
printf("\n\n\tWebsite: http://www.geocities.com/latishsherigar");
printf("\n\n\tProg version: 1.1");
printf("\n\n\n\tPress any key to continue............") ;
fflush(stdin);
scanf("%c",&ch);
}

/*============== =================HELP fun==========================*/

void help()
{
char ch;
printf("\n\n\nSPLITTER-:\n");
printf("\nFor splitting any files just give the name of the file or full directory path\n of the file if the file is in other directory. ");
printf("\nIt then asks for the output directory.Press ENTER if in the working directory orgive the full path if in other directory.");
printf("\nThe Program then asks the memory format in which you want your files to be");
printf("\nbroken to.Just enter the required format .It then asks for the size of the");
printf("\nindividual parts.");
printf("\nJust enter this and BINGO! your file is broken.");
printf("\n\n\nMERGER-:\n\n");
printf("\nThe procedure for merging the files is similar as splitting .");
printf("\nFor merging the files ,just give the name of any 1 splitted file to be \nmergeted.");
printf("\nThe program then asks for output directory.");
printf("\nThe program then does the rest for you.");
printf("\n\nPress any key to continue...........");
fflush(stdin);
scanf("%c",&ch);
}
