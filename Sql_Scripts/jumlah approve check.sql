SELECT A.*,X.*,
            ISNULL((SELECT TOP 1 Notes FROM Ext_Log_PR EL WHERE EL.PR_Code = A.PR_Code ORDER BY Created_Datetime desc ),'') as latest_note,
            (select TOP 1 C.Category_Type
            from PR_Detail D Left Join Stock_Desc B On D.Stock_code = B.Stock_Code
            , Stock_Category C WHERE B.Category_Code = C.Category_Code AND D.PR_Code = A.PR_Code) As Purchase_Type,
            (SELECT COUNT(User_Code) FROM Tier_PR C WHERE C.Dep_Code = A.Dep_Code AND C.Purchase_Type = (select TOP 1 C.Category_Type
            from PR_Detail D Left Join Stock_Desc B On D.Stock_code = B.Stock_Code
            , Stock_Category C WHERE B.Category_Code = C.Category_Code AND D.PR_Code = A.PR_Code)) AS Jumlah_Tier,
            (SELECT COUNT(Approve_By) FROM Ext_PR_Master_Approval D WHERE D.PR_Code = A.PR_Code) AS Jumlah_Approve 
            FROM PR_Master A INNER JOIN Ext_Users_Approval X ON A.CompName = X.User_Code
            WHERE A.pr_code = 'PR-202307-00598'