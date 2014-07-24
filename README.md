WhoIsOnMageOverflow
===================

After the big box office hit <a href="http://ismariusawake.com/" target="_blank">http://ismariusawake.com/</a> written an directed by <a href="https://github.com/philwinkle" target="_blank">philwinkle</a>
here comes a sequel "Who is On MageOverflow?".  
But this time...yes you guessed it...as a magento extension for Magento 1.7+.

Now you can see who can help you code Magento while you code Magento. (insert Xzibit meme here)

What it does?
-----------

It adds a menu to the backend of your magento instance.
At the end of that menu you will find a CRUD section that let's you manage the people you want to follow that have accounts on <a href="http://magento.stackexchange.com" target="_blank">http://magento.stackexchange.com</a>.

In the grid of the module you will see their last activity (answer giver) and if they are awake or not.

By default the module comes with 2 users. <a href="http://magento.stackexchange.com/users/336/philwinkle" target="_blank">philwinkle</a> and <a href="http://magento.stackexchange.com/users/146/marius" target="_blank">Marius</a>.
If you want to add more, just use the form and provide the stackexchange user id.

If you want to be part of the initial data set, just post an <a href="https://github.com/tzyganu/WhoIsOnMageOverflow/issues" target="_blank">issue</a> saying that you want to.

Uninstall:
---------

I don't know why would you want to uninstall such an awesome extension, but if you insist, you have to delete the following files and folders:

 - app/code/community/Easylife/MageOverflow/
 - app/etc/modules/Easylife_MageOverflow.xml
 - app/locale/en_US/Easylife_MageOverflow.csv
 - app/design/adminhtml/default/default/layout/easylife_mageoverflow.xml

and run the following query on your db. Add the table prefix if you have one:

<pre><code>
DROP TABLE `easylife_mageoverflow_overflowuser`;
DELETE FROM `core_resource` WHERE `code` = 'easylife_mageoverflow_setup';
</code></pre>
