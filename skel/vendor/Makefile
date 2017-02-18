# UTF-8, LF

FILES_TO_CLEAN = key.cgi

NPM = npm
SVN = svn
RM = rm -f

ifeq ($(OS),Windows_NT)
	NPM = npm.cmd
	RM = cmd.exe /C del
endif

.PHONY:
	all installdeps install clean

all: installdeps install

installdeps:
	echo installdeps

install: installdeps
	$(SVN) export https://github.com/Semantic-Org/Semantic-UI/trunk/dist semantic

clean:
	-$(RM) $(FILES_TO_CLEAN)
