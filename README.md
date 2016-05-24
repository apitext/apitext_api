# apitext_api
## what is apitext?</h3>
> Apitext is a student built prototype RESTful Application Programing Interface (API) for TEI-XML Transcriptions. Once uploaded to a TEI-XML folder on a website, it exposes a series of Uniform Resource Identifiers (URI). By using these identifier endpoints, a user can retrieve specific information from a TEI-XML file.
> Currently, our prototype only manages one TEI-XML file and only supports URI requests from the same domain as the API itself. To find out about future development plans, please see our about the project" section.

## how do I install apitext?
1. You will need to have a website capable of running PHP scripts.
2. In order for apitext to work, you will need to designate a folder on your website that will hold your TEI-XML file.
3. You will need to upload apitext into that folder.
 * You can clone or download the apitext repository <a href="https://github.com/apitext/apitext_api">here</a>.
 * Note: If you choose to download the apitext repository from Github:
  * You will need extract the base repository folder from the unzipped folder (when zipping files, Github creates a folder inside a folder).
  * You will need to remove the <code>-master</code> from the end of the base folder's name (when zipping files, Github adds "-master" to the end of the repository name).
 * You will then need to move the <code>.htaccess</code> file outside of the <code>apitext_api</code> folder.
 * You will then need to edit the <code>config.json</code> file located inside the <code>apitext_api</code> folder.
  * In the <code>teiFolder</code> entry put the name of your TEI-XML folder.
  * In the <code>teiFile</code> entry put the name of your TEI-XML file.
  * As an example, if your folder was named <code>my-tei-folder</code> and your file was named <code>my-tei-xml-file.xml</code>, then your <code>config.json</code> file would look like this:
					<pre><code class="json">
	{
	 "teiFolder": "my-tei-folder",
	 "teiFile" : "my-tei-xml-file.xml"
	}
					</code></pre></</li>
4. That's it, the API should now be controlling your TEI-XML folder. Use a web browser to navigate to your file folder, you should see a welcome message.
