#!/usr/bin/env python
import sys
from rdkit.Chem import AllChem
from rdkit import Chem

file1=open(sys.argv[1],"r")
smiles1=file1.readline();
file2=open(sys.argv[2],"r")
smiles2=file2.readline();

molecule1=Chem.MolFromSmiles(smiles2)
molecule2=Chem.MolFromSmiles(smiles1)


reactions=[]
reactions.append('[C:1](=[O:2])-[OD1].[N!H0:3]>>[C:1](=[O:2])[N:3]')
reactions.append('[C@H1:1][OH:2].[OH][C:3]=[O:4]>>[C@:1][O:2][C:3]=[O:4]')


for reaction in reactions:	
	rxn = AllChem.ReactionFromSmarts(reaction)
	ps = rxn.RunReactants((molecule1,molecule2))
	if len(ps)!=0:
		print Chem.MolToSmiles(ps[0][0],True)
	ps = rxn.RunReactants((molecule2,molecule1))
	if len(ps)!=0:
		print Chem.MolToSmiles(ps[0][0],True)	

