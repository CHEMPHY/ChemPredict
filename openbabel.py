#!/usr/bin/env python
import sys
import os
import glob
from rdkit.Chem import AllChem
from rdkit import Chem

file1=open(sys.argv[1],"r")
smiles1=file1.readline();
file2=open(sys.argv[2],"r")
smiles2=file2.readline();

molecule1=Chem.MolFromSmiles(smiles2)
molecule2=Chem.MolFromSmiles(smiles1)


reactions=[]
reactions.append('[C:1](=[O:2])-[OD1].[N!H0:3]>>[C:1](=[O:2])[N:3]')  #amination
reactions.append('[C:1][OH:2].[OH][C:3]=[O:4]>>[C:1][O:2][C:3]=[O:4]') #esterification

for reaction in reactions:	
	rxn = AllChem.ReactionFromSmarts(reaction)
	ps = rxn.RunReactants((molecule1,molecule2))
	if len(ps)!=0:
		uniqps={}
		for product in ps:
			smi=Chem.MolToSmiles(product[0],True)
			uniqps[smi]=product[0]
		for key in uniqps:
			print key

	ps = rxn.RunReactants((molecule2,molecule1))
	if len(ps)!=0:
		uniqps={}
		for product in ps:
			smi=Chem.MolToSmiles(product[0],True)
			uniqps[smi]=product[0]
		for key in uniqps:
			print key


'''

i=0
os.chdir("/home/mzhu7/chemroutes/rxn")
for file in glob.glob("*.rxn"):
	#print file
	try:
		rxn=AllChem.ReactionFromRxnFile(file)
		if rxn.GetNumReactantTemplates()==2:			
			#print i	
			ps = rxn.RunReactants((molecule1,molecule2))				
			i=i+1
			if len(ps)!=0:
				for i in range(0, len(ps)):
					print Chem.MolToSmiles(ps[0][0],True)	
			ps = rxn.RunReactants((molecule2,molecule1))
			if len(ps)!=0:
				for i in range(0, len(ps)):
					print Chem.MolToSmiles(ps[0][0],True)
	except:
		pass


'''	