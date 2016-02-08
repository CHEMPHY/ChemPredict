#!/usr/bin/env python
from rdkit.Chem import AllChem
from rdkit import Chem

file1=open("uploads/alcohol.smi","r")
smiles1=file1.readline();
file2=open("uploads/acid.smi","r")
smiles2=file2.readline();


rxn = AllChem.ReactionFromSmarts('[C:1](=[O:2])-[OD1].[N!H0:3]>>[C:1](=[O:2])[N:3]')
rxn = AllChem.ReactionFromSmarts('[C@H1:1][OH:2].[OH][C:3]=[O:4]>>[C@:1][O:2][C:3]=[O:4]')
ps = rxn.RunReactants((Chem.MolFromSmiles(smiles2),Chem.MolFromSmiles(smiles1)))
ps= rxn.RunReactants((Chem.MolFromSmiles(smiles1),Chem.MolFromSmiles(smiles2)))
print Chem.MolToSmiles(ps[0][0],True)
