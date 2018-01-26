# Copyright Dominic Swaine Holdings Limited 2018 to present.
# Registered office 35 Shirley Drive, Hove, United Kingdom  BN3 6UA

from bs4 import BeautifulSoup as soup
import urllib,time,re,lxml,json

alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z']
posRegex = {
	"verbForm": re.compile("{{head\|en\|verb form}}"),
	"verbStem": re.compile("{{en-verb[^{}]*}}"),
	"verbSimplePast": re.compile("{{en-simple past of|[^{}]*}}"),
	"verbThirdPersonSingular": re.compile("{{en-third-person singular of\|[^{}]*}}"),
	"verbPastParticipleForm": re.compile("{{head\|en\|past participle}}"),
	"verbPastParticiple": re.compile("{{past participle of\|[^{}]*\|lang=en[^{}]*}}"),
	"nounStem": re.compile("{{en-noun[^{}]*}}"),
	"nounPluralForm": re.compile("{{head\|en\|noun plural form}}"),
	"nounPluralForm": re.compile("{{plural of|^{}]*|lang=en}}"),
	"adjStem": re.compile("{{en-adj[^{}]*}}"),
	"adjComparativeForm": re.compile("{{head\|en\|adjective comparative form}}"),
	"adjComparative": re.compile("{{en-comparative of|[^{}]*}}"),
	"adjSuperlativeForm": re.compile("{{head\|en\|adjective superlative form}}"),
	"adjSuperlative": re.compile("{{en-superlative of|[^{}]*}}"),
	"avdStem": re.compile("{{en-adv[^{}]*}}")
}

def urlLoad(url):
	try:return urllib.urlopen(url).read()
	except:
		print(" ! "+ str(time.strftime("%H:%M:%S"))+": Offline. Retrying connection... ("+url+')')
		time.sleep(5)
		return urlLoad(url)
def passJson(url):
	try:return json.loads(urlLoad(url))
	except:
		print("Something went wrong in passing the JSON file... Retrying...")
		time.sleep(5)
		passJson(url)
def formatUrl(baseUrl,parameters):
	return baseUrl+"?"+urllib.urlencode(parameters,doseq=True)
def isLatin(str):
	for c in list(str):
		if c not in alphabet:
			return False
	return True

def processEntry(entry):
	#output = []
	if isLatin(entry)==True:
		url = formatUrl(
			"https://en.wiktionary.org/w/api.php",
			{"action":"query","titles":entry,"prop":"revisions","rvprop":"content","format":"xml"}
		)
		#print "\n",entry
		rawResource = soup(urlLoad(url),"lxml").find('rev')
		if rawResource != None:
			for m in re.finditer(r"{{(?:(?:en-)|(?:head\|en\|))[^{}]*}}", unicode(rawResource)):
				print m.group(0)
				#for POS, REGEX in posRegex.iteritems():
				#	if REGEX.match(m.group(0)):
				#		output.append([POS,m.start(),m.end(), m.group(0)])
				#		break
		#print output

count  = 0;
with open("/Users/dominicswaine/Desktop/Snippet/enwiktionary-20180101-pages-articles-multistream-index.txt") as infile:
	for line in infile:
		processEntry(line.split(":",2)[2].strip())
		count +=1;
		if count>=1000:
			exit()
